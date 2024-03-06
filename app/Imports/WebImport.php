<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Services\WhatsappService;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Importedlead;


class WebImport implements ToCollection,WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
   
        foreach ($rows as $key => $row) {
            
            // $key=$key+1;
           $optin= WhatsappService::optin($row['mobile']);
$message="Dear sir/ma'am,
Thank you for showing interest in our services.
We at ORAD feel very fortunate to receive queries from your end and we assure you  that we will try our best to do every possible way  to resolve all your career related problems.

You can book a absolutely free one-on-one live interactive demo session by visiting  our website www.orad.in or  by giving us a call on following number. We at ORAD are available here 24*7 to entertain your queries.

Feel free to contact us anytime to find potentially life changing course for your professional and personal growth .From focussing towards your learning capabilities to assisting you all the way for a better career, life and education path, ORAD does it all . Our goal is to provide you  highly customised and unique experience while improving your proficiency in English.

www.orad.in 
7023257320";

// $message="नमस्कार श्रीमान/श्रीमती,

// हम ORAD Consultancy, खुद को भाग्यवान समझते हैं, की आपने हमारे साथ अपना प्रश्न एवं समस्या सांझा की, हम हर संभव प्रयास करेंगे की घर बैठे आप के बेटे/बेटी की भविष्य, करियर और अंग्रेजी से जुड़ी समस्या हल करने का।

// आपसे अनुरोध की आप हमारे one-to-one (यानी एक विधार्थी के लिए एक ही शिक्षक) घर बैठे मुफ्त demo क्लास ले, यह क्लास खास तौर पर विद्यार्थी की बौद्धिक शक्ति और समझदारी के हिसाब से हर एक विद्यार्थी को अलग अलग दिया जाता हैं। अगर आप यह घर बैठे मुफ्त demo लेते हैं तो आप बेहतर समझ पाएंगे की आपके बेटे/बेटी को अंग्रेजी भाषा में क्या समस्या हैं, और उसका हल हम कैसे करेंगे।

// आप जब चाहे तब हमारी वेबसाइट या फिर दिए गए नंबर पर फोन कर सकते हैं, हमारी कंपनी हर विद्यार्थी को बेहतर भविष्य और अंग्रेजी भाषा पर प्रभुत्व दिलाने के लिए कटिबद्ध हैं।
// www.orad.in 
// 7723257320";

           $message= WhatsappService::sendmessage($message,$row['mobile']);
        //    $id=Importedlead::create(['mobile'=>$row['mobile'],'optin'=>$optin,'template'=>$message,'responseoptin'=>$optin,'responsesendmessage'=>$message]);
        
        }
    }
}
