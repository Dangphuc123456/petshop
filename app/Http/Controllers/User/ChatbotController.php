<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Pet;
use App\Models\Room;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use OpenAI\Laravel\Facades\OpenAI;

class ChatbotController extends Controller
{
    public function showChat()
    {
        return view('chatbot');
    }

    public function handleChat(Request $request)
    {
        // Lấy nội dung tin nhắn người dùng gửi lên từ giao diện
        $userMsg = $request->input('message');

        // 1. Lấy tên các sản phẩm từ bảng Pet (tối đa 10 tên đầu tiên để hiển thị)
        $products = Pet::pluck('description')->toArray();
        $categories = Category::pluck('category_name')->toArray();
        $services = Service::select('ServiceName', 'Price', 'ServiceDuration')->get();
        $serviceList = $services->map(function ($item) {
            return "{$item->ServiceName} (Giá: " . number_format($item->Price) . "đ, Thời gian: {$item->ServiceDuration} phút)";
        })->implode(', ');
        $room = Room::select( 'PricePerNight')->get();
        $roomList = $room->map(function ($item) {
            return "(Giá: " . number_format($item->PricePerNight) . "đ/đêm)";
        })->implode(', ');
        // 2. Danh sách chính sách của shop
        $policies = [
            'Shop hỗ trợ đổi trả trong vòng 7 ngày nếu sản phẩm chó, mèo hoặc phụ kiện bị lỗi, hỏng hóc hoặc không đúng như mô tả. Vui lòng giữ nguyên tình trạng sản phẩm và hóa đơn để được hỗ trợ nhanh nhất.',
            'Bảo hành phụ kiện 6 tháng',
            'Chúng tôi miễn phí giao hàng cho các đơn hàng trong bán kính 30km quanh cửa hàng. Nếu đơn hàng của bạn ngoài phạm vi này, sẽ có phụ phí 30.000 đồng.'
        ];
        $policyText = implode(" | ", $policies);

        // 3. Thông tin chung về shop
        $productsList = implode(', ', array_slice($products, 0, 10));
        if (count($products) > 10) {
            $productsList .= ', ...';
        }

        $shopInfo = [
            'products' => $productsList,
            'policies' => $policyText,
            'opening'  => '8:00–20:00 mỗi ngày',
            'address'  => 'Cửa Hàng Miền Bắc: Số 293 Minh Khai, Quận Hai Bà Trưng, Tp. Hà Nội. và Cửa Hàng Miền Nam: 1045 Đường Kha Vạn Cân, Phường Linh Trung, Thủ Đức, Tp.HCM.',
            'categories' => implode(', ', $categories),
            'service'   => $serviceList,
            'room'      => $roomList,
        ];

        // 4. Prompt cho chatbot
        $systemPrompt = <<<EOD
Bạn là Petshop Bot 🐾 - một trợ lý thân thiện cho khách hàng.
Dưới đây là thông tin về cửa hàng:

- 🐶 Sản phẩm: {$shopInfo['products']}
- 📜 Chính sách: {$shopInfo['policies']}
- 🕗 Giờ mở cửa: {$shopInfo['opening']}
- 📍 Địa chỉ: {$shopInfo['address']}
- 🗂️ Loại sản phẩm: {$shopInfo['categories']}
- 🛠️ Dịch vụ: {$shopInfo['service']}
-🏨 Giá khách sạn thú cưng: {$shopInfo['room']}

Nếu người dùng hỏi về sản phẩm, chính sách, giờ mở cửa hoặc địa chỉ, hãy trả lời trực tiếp từ thông tin ở trên.
Nếu câu hỏi không liên quan, hãy trả lời thân thiện như một trợ lý thông minh và hài hước.
EOD;
        try {
            // 5. Gửi yêu cầu đến OpenAI API
            $response = OpenAI::chat()->create([
                'model'    => config('services.openai.default_model'),
                'messages' => [
                    ['role' => 'system', 'content' => $systemPrompt],
                    ['role' => 'user',   'content' => $userMsg],
                ],
                'temperature' => 0.6,
                'max_tokens'  => 200,
            ]);

            // 6. Trích xuất câu trả lời từ AI
            $reply = trim($response->choices[0]->message->content);

            return response()->json([
                'reply' => $reply
            ]);
        } catch (\Exception $e) {
            // Ghi log lỗi nếu cần
            Log::error("Chatbot error: " . $e->getMessage());

            return response()->json([
                'reply' => 'Lỗi khi gọi AI: ' . $e->getMessage()
            ], 500);
        }
    }
}
