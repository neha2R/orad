<?php

use Carbon\Carbon;
use App\Models\Demo;
use App\Models\Slot;
use App\Models\User;
use App\Models\Content;
use App\Models\Courses;
use App\Models\FeedBack;
use App\Models\Department;
use App\Models\LeadStatus;
use App\Models\UserDetail;
use Carbon\CarbonInterval;
use App\Models\CoursesType;
use App\Models\LeadHistory;
use App\Models\ParentsDetail;
use App\Models\SubDepartment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Notifications\NewUserRegisteration;

/**
 * get lead parent details (parent = sales, tranner details)
 * 
 * @param leadid, 
 * @param parentname (sales, tranner)
 * @return response
 */
function leadJuniorMarketingProfile($leadid, $prentname)
{
    $leadParent = LeadStatus::where('leadid',$leadid)->where('department','3')->first();
    if ($leadParent != null) {
        return User::where('id',$leadParent->assignto)->first()->name ?? 'N/A';
        
    }else {
        return 'N/A';
    }
}
function countryCodes()
{
    return [
        '91' => 'India (+91)',
        '44' => 'UK (+44)',
        '1' => 'USA (+1)',
        '213' => 'Algeria (+213)',
        '376' => 'Andorra (+376)',
        '244' => 'Angola (+244)',
        '1264' => 'Anguilla (+1264)',
        '1268' => 'Antigua & Barbuda (+1268)',
        '54' => 'Argentina (+54)',
        '374' => 'Armenia (+374)',
        '297' => 'Aruba (+297)',
        '61' => 'Australia (+61)',
        '43' => 'Austria (+43)',
        '994' => 'Azerbaijan (+994)',
        '1242' => 'Bahamas (+1242)',
        '973' => 'Bahrain (+973)',
        '880' => 'Bangladesh (+880)',
        '1246' => 'Barbados (+1246)',
        '375' => 'Belarus (+375)',
        '32' => 'Belgium (+32)',
        '501' => 'Belize (+501)',
        '229' => 'Benin (+229)',
        '1441' => 'Bermuda (+1441)',
        '975' => 'Bhutan (+975)',
        '591' => 'Bolivia (+591)',
        '387' => 'Bosnia Herzegovina (+387)',
        '267' => 'Botswana (+267)',
        '55' => 'Brazil (+55)',
        '673' => 'Brunei (+673)',
        '359' => 'Bulgaria (+359)',
        '226' => 'Burkina Faso (+226)',
        '257' => 'Burundi (+257)',
        '855' => 'Cambodia (+855)',
        '237' => 'Cameroon (+237)',
        '1' => 'Canada (+1)',
        '238' => 'Cape Verde Islands (+238)',
        '1345' => 'Cayman Islands (+1345)',
        '236' => 'Central African Republic (+236)',
        '56' => 'Chile (+56)',
        '86' => 'China (+86)',
        '57' => 'Colombia (+57)',
        '269' => 'Comoros (+269)',
        '242' => 'Congo (+242)',
        '682' => 'Cook Islands (+682)',
        '506' => 'Costa Rica (+506)',
        '385' => 'Croatia (+385)',
        '53' => 'Cuba (+53)',
        '90392' => 'Cyprus North (+90392)',
        '357' => 'Cyprus South (+357)',
        '42' => 'Czech Republic (+42)',
        '45' => 'Denmark (+45)',
        '253' => 'Djibouti (+253)',
        '1809' => 'Dominica (+1809)',
        '1809' => 'Dominican Republic (+1809)',
        '593' => 'Ecuador (+593)',
        '20' => 'Egypt (+20)',
        '503' => 'El Salvador (+503)',
        '240' => 'Equatorial Guinea (+240)',
        '291' => 'Eritrea (+291)',
        '372' => 'Estonia (+372)',
        '251' => 'Ethiopia (+251)',
        '500' => 'Falkland Islands (+500)',
        '298' => 'Faroe Islands (+298)',
        '679' => 'Fiji (+679)',
        '358' => 'Finland (+358)',
        '33' => 'France (+33)',
        '594' => 'French Guiana (+594)',
        '689' => 'French Polynesia (+689)',
        '241' => 'Gabon (+241)',
        '220' => 'Gambia (+220)',
        '7880' => 'Georgia (+7880)',
        '49' => 'Germany (+49)',
        '233' => 'Ghana (+233)',
        '350' => 'Gibraltar (+350)',
        '30' => 'Greece (+30)',
        '299' => 'Greenland (+299)',
        '1473' => 'Grenada (+1473)',
        '590' => 'Guadeloupe (+590)',
        '671' => 'Guam (+671)',
        '502' => 'Guatemala (+502)',
        '224' => 'Guinea (+224)',
        '245' => 'Guinea - Bissau (+245)',
        '592' => 'Guyana (+592)',
        '509' => 'Haiti (+509)',
        '504' => 'Honduras (+504)',
        '852' => 'Hong Kong (+852)',
        '36' => 'Hungary (+36)',
        '354' => 'Iceland (+354)',
        '62' => 'Indonesia (+62)',
        '98' => 'Iran (+98)',
        '964' => 'Iraq (+964)',
        '353' => 'Ireland (+353)',
        '972' => 'Israel (+972)',
        '39' => 'Italy (+39)',
        '1876' => 'Jamaica (+1876)',
        '81' => 'Japan (+81)',
        '962' => 'Jordan (+962)',
        '7' => 'Kazakhstan (+7)',
        '254' => 'Kenya (+254)',
        '686' => 'Kiribati (+686)',
        '850' => 'Korea North (+850)',
        '82' => 'Korea South (+82)',
        '965' => 'Kuwait (+965)',
        '996' => 'Kyrgyzstan (+996)',
        '856' => 'Laos (+856)',
        '371' => 'Latvia (+371)',
        '961' => 'Lebanon (+961)',
        '266' => 'Lesotho (+266)',
        '231' => 'Liberia (+231)',
        '218' => 'Libya (+218)',
        '417' => 'Liechtenstein (+417)',
        '370' => 'Lithuania (+370)',
        '352' => 'Luxembourg (+352)',
        '853' => 'Macao (+853)',
        '389' => 'Macedonia (+389)',
        '261' => 'Madagascar (+261)',
        '265' => 'Malawi (+265)',
        '60' => 'Malaysia (+60)',
        '960' => 'Maldives (+960)',
        '223' => 'Mali (+223)',
        '356' => 'Malta (+356)',
        '692' => 'Marshall Islands (+692)',
        '596' => 'Martinique (+596)',
        '222' => 'Mauritania (+222)',
        '269' => 'Mayotte (+269)',
        '52' => 'Mexico (+52)',
        '691' => 'Micronesia (+691)',
        '373' => 'Moldova (+373)',
        '377' => 'Monaco (+377)',
        '976' => 'Mongolia (+976)',
        '1664' => 'Montserrat (+1664)',
        '212' => 'Morocco (+212)',
        '258' => 'Mozambique (+258)',
        '95' => 'Myanmar (+95)',
        '264' => 'Namibia (+264)',
        '674' => 'Nauru (+674)',
        '977' => 'Nepal (+977)',
        '31' => 'Netherlands (+31)',
        '687' => 'New Caledonia (+687)',
        '64' => 'New Zealand (+64)',
        '505' => 'Nicaragua (+505)',
        '227' => 'Niger (+227)',
        '234' => 'Nigeria (+234)',
        '683' => 'Niue (+683)',
        '672' => 'Norfolk Islands (+672)',
        '670' => 'Northern Marianas (+670)',
        '47' => 'Norway (+47)',
        '968' => 'Oman (+968)',
        '680' => 'Palau (+680)',
        '507' => 'Panama (+507)',
        '675' => 'Papua New Guinea (+675)',
        '595' => 'Paraguay (+595)',
        '51' => 'Peru (+51)',
        '63' => 'Philippines (+63)',
        '48' => 'Poland (+48)',
        '351' => 'Portugal (+351)',
        '1787' => 'Puerto Rico (+1787)',
        '974' => 'Qatar (+974)',
        '262' => 'Reunion (+262)',
        '40' => 'Romania (+40)',
        '7' => 'Russia (+7)',
        '250' => 'Rwanda (+250)',
        '378' => 'San Marino (+378)',
        '239' => 'Sao Tome & Principe (+239)',
        '966' => 'Saudi Arabia (+966)',
        '221' => 'Senegal (+221)',
        '381' => 'Serbia (+381)',
        '248' => 'Seychelles (+248)',
        '232' => 'Sierra Leone (+232)',
        '65' => 'Singapore (+65)',
        '421' => 'Slovak Republic (+421)',
        '386' => 'Slovenia (+386)',
        '677' => 'Solomon Islands (+677)',
        '252' => 'Somalia (+252)',
        '27' => 'South Africa (+27)',
        '34' => 'Spain (+34)',
        '94' => 'Sri Lanka (+94)',
        '290' => 'St. Helena (+290)',
        '1869' => 'St. Kitts (+1869)',
        '1758' => 'St. Lucia (+1758)',
        '249' => 'Sudan (+249)',
        '597' => 'Suriname (+597)',
        '268' => 'Swaziland (+268)',
        '46' => 'Sweden (+46)',
        '41' => 'Switzerland (+41)',
        '963' => 'Syria (+963)',
        '886' => 'Taiwan (+886)',
        '7' => 'Tajikstan (+7)',
        '66' => 'Thailand (+66)',
        '228' => 'Togo (+228)',
        '676' => 'Tonga (+676)',
        '1868' => 'Trinidad & Tobago (+1868)',
        '216' => 'Tunisia (+216)',
        '90' => 'Turkey (+90)',
        '7' => 'Turkmenistan (+7)',
        '993' => 'Turkmenistan (+993)',
        '1649' => 'Turks & Caicos Islands (+1649)',
        '688' => 'Tuvalu (+688)',
        '256' => 'Uganda (+256)',
        '380' => 'Ukraine (+380)',
        '971' => 'United Arab Emirates (+971)',
        '598' => 'Uruguay (+598)',
        '7' => 'Uzbekistan (+7)',
        '678' => 'Vanuatu (+678)',
        '379' => 'Vatican City (+379)',
        '58' => 'Venezuela (+58)',
        '84' => 'Vietnam (+84)',
        '84' => 'Virgin Islands - British (+1284)',
        '84' => 'Virgin Islands - US (+1340)',
        '681' => 'Wallis & Futuna (+681)',
        '969' => 'Yemen (North)(+969)',
        '967' => 'Yemen (South)(+967)',
        '260' => 'Zambia (+260)',
        '263' => 'Zimbabwe (+263)',
    ];
}

function indianStates()
{
    $indianStates = [
        'Arunachal Pradesh',
        'Assam',
        'Bihar',
        'Chhattisgarh',
        'Goa',
        'Gujarat',
        'Haryana',
        'Himachal Pradesh',
        'Jammu and Kashmir',
        'Jharkhand',
        'Karnataka',
        'Kerala',
        'Madhya Pradesh',
        'Maharashtra',
        'Manipur',
        'Meghalaya',
        'Mizoram',
        'Nagaland',
        'Odisha',
        'Punjab',
        'Rajasthan',
        'Sikkim',
        'Tamil Nadu',
        'Telangana',
        'Tripura',
        'Uttar Pradesh',
        'Uttarakhand',
        'West Bengal',
        'Andaman and Nicobar Islands',
        'Chandigarh',
        'Dadra and Nagar Haveli',
        'Daman and Diu',
        'Lakshadweep',
        'National Capital Territory of Delhi',
        'Puducherry',
    ];
    return $indianStates;
}

function referencearray()
{
    return collect(['Webinar', 'Instagram', 'Google', 'Facebook', 'Twitter', 'Others']);
}

function rolesHelper($role)
{
    switch ($role) {
        case 0:
            return 'CEO';
            break;
        case 1:
            return 'Admin';
            break;
        case 2:
            return 'Senior';
            break;
        case 3:
            return 'Junior';
            break;
        default:
            # code...
            break;
    }
}

/**
 * Logged in user post (admin/ BDE/ BDM)
 * 
 * @return Response(user role)
 */
function userPost()
{
    return userDepartment(auth()->user()->id);
}

function userDepartment($userid)
{
    $user = User::find($userid);
    $usertype = $user->user_type;
    $role = $user->role;
    $department = $user->department;
    $sub_department = $user->sub_department;

    if ($usertype == 2 ) {
        return 'Student';
    }
    switch ($department) {
        case 1:
            return 'CEO';
            break;
        case 2:
            return 'Admin';
            break;
        case 3:
            switch ($role) {
                case 3:
                    if ($sub_department == 2) {
                        return 'BDE Intern';
                        break;
                    }else {
                        return 'BDE Junior';
                        break;
                    }
                // return redirect('/sales/juniordashboard');
                default:
                    if ($sub_department == 2) {
                        return 'BDE Team Lead';
                        break;
                    }else {
                        return 'BDM Team Lead';
                        break;
                    }
            }
            
            break;
        case 4:
            switch ($role) {
                case 3:
                    if ($sub_department == 3) {
                        return 'Demo Trainer';
                        break;
                    }else {
                        return 'Class Trainer';
                        break;
                    }
                
                default:
                    if ($sub_department == 3) {
                        return 'Demo Manager';
                        break;
                    }else {
                        return 'Quality Assurance';
                        break;
                    }
            }
            break;
        case 5:
            switch ($role) {
                case 3:
                    return 'Junior Content writter';
                    break;
                
                default:
                    return 'Senior Content writter';
                    break;
            }
            break;
        case 6:
            return 'Accounts';
            break;
        case 7:
            switch ($sub_department) {
                case 5:
                    return 'Talent Hunt';
                    break;
                
                case 6:
                    return 'Training & Development';
                    break;
                
                default:
                    return 'Performance Management';
                    break;
            }
            break;
        default:
            # code...
            break;
    }
}
function svgDownArrow()
{
    return (
        '<svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>'
    );
}
/**
 * check photo exists in data base and folder
 * 
 * @param user_id
 * @return photo_path
 */
function userPhoto($userid)
{
    $data = User::find($userid);
    $dummyPhoto = asset("img/avatar/oradavatar.jpg");
    if ($data != null && $data->profileimage != null) {
        $thumbnail = $data->profileimage;
        $result = \Storage::disk('public')->exists($data->profileimage) ? asset("/storage/$thumbnail") : $dummyPhoto;
    }else {
        $result = $dummyPhoto;
    }
    
    return $result;
}

function getReference($ref)
{
    switch ($ref) {
        case 0:
            $reference = 'Webinar';
            break;
        case 1:
            $reference = 'Instagram';
            break;
        case 2:
            $reference = 'Google';
            break;
        case 3:
            $reference = 'Facebook';
            break;
        case 4:
            $reference = 'Twitter';
            break;
        default:
            $reference = 'N/A';
            break;
    }
    return $reference;
}

function growthOptions()
{
    return [
        'A (Can speak well)',
        'B (Can speak but is not fluent)',
        'C (Can understand but is not able to speak)',
        'D (Can not understand at all)',
    ];
}

function growthDetails($growth)
{
    switch ($growth) {
        case (0):
        return 'A (Can speak well)';
        break;
        case (1):
        return 'B (Can speak but is not fluent)';
        break;
        case (2):
        return 'C (Can understand but is not able to speak)';
        break;
        case (3):
        return 'D (Can not understand at all)';
        break;
        
        default:
            return 'N/A';
            break;
    }
}

function edulevelOptions()
{
    return [
        'School',
        'UG',
        'PG',
        'Job Seeker',
        'Working',
        'Housewife',
        'Other',
        'self',
    ];
}

function educationDetails($edulevel)
{
    switch ($edulevel) {
        case (0):
            return 'School';
            break;

        case (1):
            return 'UG';
            break;

        case (2):
            return 'PG';
            break;

        case (3):
            return 'Job Seeker';
            break;

        case (4):
            return 'Working';
            break;

        case (5):
            return 'Housewife';
            break;

        case (6):
            return 'Other';
            break;

        case (7):
            return 'self';
            break;

        default:
            return 'N/A';
            break;
    }
}

function genderOptions()
{
    return [
        'Male',
        'Female',
        'Prefer not to say',
    ];
}

function checkifpending($id)
{
    $check = User::where('id', $id)->where('created_at', '<', Carbon::now()->subDays(3))->first();
    return $check;
}

function behaviourCode()
{
    return ['good', 'decent', 'bad'];
}

function courselike(){
    return ['Okay', 'Like',  'Most Likely', 'Dislike'];
}

function getcontentfordemo($contentarr){
    $content = Content::whereIn('id', $contentarr)->get();
    return $content;
}

// function newregisterationmessages($userid, $username, $userdepartment)
// {
//     //admin message
//     $ceomessage = "" . $username . " joined the company in " . $userdepartment . "";
//     $ceo = User::where(["department" => 1, "role" => 0])->first();
//     User::where(["department" => 1, "role" => 0])->first()->notify(new NewUserRegisteration($ceomessage, $ceo->id));
//     $adminmessage = "The user id for " . $username . " has been created.";
//     $admin = User::where(["department" => 2, "role" => 1])->first();
//     User::where(["department" => 2, "role" => 1])->first()->notify(new NewUserRegisteration($adminmessage, $admin->id));
//     $usermessage = "Dear " . $username . " Your user ID has been created. Happy working Team ORAD";
//     User::findorFail($userid)->notify(new NewUserRegisteration($usermessage, $userid));
// }

// function userassignmentprocess($username, $seniormanagername, $seniormanagerid, $userid)
// {
//     $ceomessage = "" . $username . " is assigned under " . $seniormanagername . "";
//     $ceo = User::where(["department" => 1, "role" => 0])->first();
//     User::where(["department" => 1, "role" => 0])->first()->notify(new NewUserRegisteration($ceomessage, $ceo->id));
//     $adminmessage = "You have assigned " . $username . " under " . $seniormanagername . "";
//     $admin = User::where(["department" => 2, "role" => 1])->first();
//     User::where(["department" => 2, "role" => 1])->first()->notify(new NewUserRegisteration($adminmessage, $admin->id));
//     $seniormessage = "" . $username . " is assigned under you";
//     User::findorFail($seniormanagerid)->notify(new NewUserRegisteration($seniormessage, $seniormanagerid));
//     $usermessage = "You have been assigned under " . $seniormanagername . "";
//     User::findorFail($userid)->notify(new NewUserRegisteration($usermessage, $userid));
// }

// function demoovermessage($leadid, $userid)
// {
//     $leadstatus = LeadStatus::findorFail($leadid);
//     $juniormarketingid = $leadstatus->assignedto;
//     $seniormarketingid = $leadstatus->assignedby;
//     $userdetails = User::findorFail($userid);
//     $junior = User::findorFail($juniormarketingid);
//     $seniormessage = "The demo of " . $userdetails->name . " was succesful. Please keep the track of follow up by " . $junior->name . ".";
//     User::findorFail($seniormarketingid)->notify(new NewUserRegisteration($seniormessage, $seniormarketingid));
//     $juniormessage = "The demo of " . $userdetails->name . " was succesfully completed. Please follow up.";
//     User::findorFail($juniormarketingid)->notify(new NewUserRegisteration($juniormessage, $juniormarketingid));
// }

// function assignleadseniorsalestoseniormarketing($noofleads, $seniorsalesid, $juniorsalesid)
// {
//     $juniormarketingname = User::findorFail($juniorsalesid)->name;
//     $seniormessage = "You have assigned " . $noofleads . " to " . $juniormarketingname . ".";
//     User::findorFail($seniorsalesid)->notify(new NewUserRegisteration($seniormessage, $seniorsalesid));
//     $juniormessage = "Wake up! Time to work, New leads in the house.";
//     User::findorFail($juniorsalesid)->notify(new NewUserRegisteration($juniormessage, $juniormessage));
// }

// function leadassignedtoseniorsales($seniorsalesid, $userid)
// {
//     $userdetails = User::findorFail($userid);
//     $message = "Demo for " . $userdetails->name . " yet to be assigned to a trainer.";
//     User::findorFail($seniorsalesid)->notify(new NewUserRegisteration($message, $seniorsalesid));
// }

// function leadassignjuniorsalestoseniormarketing($juniormarketingid, $seniormarketing, $userid)
// {
//     $juniormarketing = User::findorFail($juniormarketingid);
//     $clientinfo = User::findorFail($userid);
//     $datetime = Carbon::now();
//     $seniormessage = "" . $juniormarketing->name . " has  added a new demo for " . $clientinfo->name . " at " . $datetime . ".";
//     User::findorFail($seniormarketing)->notify(new NewUserRegisteration($seniormessage, $seniormarketing));

//     $juniormessage = "The demo of " . $clientinfo->name . " has been created and forwarded.";
//     User::findorFail($juniormarketingid)->notify(new NewUserRegisteration($juniormessage, $juniormarketingid));
// }

// function demoStatusHelper($id)
// {
//     try {
//         $leadstatus = LeadStatus::findorFail($id);
//         $demostatus = 0;
//         $demodate = $leadstatus->demoStatus->date;
//         $demotime = $leadstatus->demoStatus->slotRelation->to;
//         $datetime = (string) $demodate . ' ' . (string) $demotime;
//         $carbondatetime = Carbon::parse($datetime);
//         if ($carbondatetime->gt(Carbon::now())) {
//             $demostatus = 1;
//             return $demostatus;
//         } else {
//             if ($leadstatus->demoStatus->is_demodone) {
//                 $demostatus = 2;
//                 return $demostatus;
//             } else {
//                 $demostatus = 3;
//                 return $demostatus;
//             }
//         }
//     } catch (\Throwable $th) {
//         Log::critical($th);
//         $demostatus = 4;
//         return $demostatus;
//     }

// }

function demoHelperColor($id){
    try {
        $leadstatus = LeadStatus::find($id);
        if($leadstatus->demoStatus){
            $demodate = $leadstatus->demoStatus->date;
            $demotime = $leadstatus->demoStatus->slotRelation->to;
            $demofrom = $leadstatus->demoStatus->slotRelation->from;
            $datetime = (string) $demodate . ' ' . (string) $demotime;
            $carbondatetime = Carbon::parse($datetime);
            if ($leadstatus->demoStatus->is_demodone) {
                return 'btn btn-warning waves-effect';
            } else {
                if ($carbondatetime->gt(Carbon::now())) {
                    // $demodate= strtotime($demodate);
                    // $demodate=date_format($demodate, "d/m/Y");
                   return "btn btn-danger waves-effect ";
                } else {
                    return 'btn btn-danger waves-effect';
                }
                
            }
            
        }else{
            return 'btn btn-danger waves-effect';
        }
}catch (\Throwable $th) {
        
    $demostatus = 'btn btn-secondary waves-effect';
    return $demostatus;
}
}

function demoHelperText($id=0)
{
    
    try {
        
        $leadstatus = LeadStatus::where('leadid',$id)->where('demoid','!=','0')->latest()->first();
        
        if($leadstatus->demoStatus){
            $demodate = $leadstatus->demoStatus->date;
            $demotime = $leadstatus->demoStatus->slotRelation->to;
            $demofrom = $leadstatus->demoStatus->slotRelation->from;
            $datetime = (string) $demodate . ' ' . (string) $demotime;
            $carbondatetime = Carbon::parse($datetime);
            if ($leadstatus->demoStatus->is_demodone) {
                return 'Demo is Done';
            } else {
                if ($carbondatetime->gt(Carbon::now())) {
                    // $demodate= strtotime($demodate);
                    // $demodate=date_format($demodate, "d/m/Y");
                   return "Demo will start {$demodate} {$demofrom} {$demotime} ";
                } else {
                    return 'Demo is Not Done';
                }
                
            }
            
        }else{
            return 'No Demo Slot Assigned Yet';
        }
        
       
    } catch (\Throwable $th) {
        
        $demostatus = 'No Demo Slot Assigned Yet';
        return $demostatus;
    }
}

function feedBackHelpers($demoid, $type)
{
    try {
        $feedback = FeedBack::where(['demoid' => $demoid, 'feedback_type' => $type])->first();
        if ($feedback->demo_taken) {
            return  "comment:{$feedback->comment},behaviour:{$feedback->behaviour},interested:{$feedback->interested},decisionmaker:{$feedback->fathername},course:{$feedback->course}";
        } else {
            return  "dropreason:{$feedback->dropreason}";
        }
        
       
    } catch (\Throwable $th) {
        return 'N/A';
    }

}

function langaugeOptions()
{
    return ['HINDI', 'ENGLISH'];
}

function dateformat($date)
{
    return date_format($date, "d/m/Y H:i:s");
}

function leadtype()
{
    return [
        1 => 'Not Called Yet',
        2 => 'Cold',
        3=>'Warm',
        4=>'Hot'
    ];
}

/**
 * show lead type details 
 * 
 * @param int leadid
 * @return response
 */
function leadTypeDetails($type)
{
    switch ($type) {
        case 1:
            return 'Not Called Yet';
            break;
        
        case 2:
            return 'Cold';
            break;
        
        case 3:
            return 'Warm';
            break;
        
        case 4:
            return 'Hot';
            break;
        
        default:
            # code...
            break;
    }
}

function assingntoName($item)
{
    try {
        return optional($item->userRelation)->assignedtouser(auth()->user()->id, optional($item->userRelation)->id)->userAssignedTo->name;

    } catch (\Throwable $th) {
        return 'N/A';
    }
}

function leadHistoryCreate($leadid, $message)
{
    $message = LeadHistory::create(['leadid' => $leadid, 'description' => $message]);
    return $message;
}

function leadRegister($title = null, $message = null,  $seniorid=null)
{
    $title = $title ?? 'New lead register';
    $message = $message ?? 'New Lead Register';
    $senior = User::where(['department'=>'2', 'role'=>'1'])->first();
    $senior->notify(new NewUserRegisteration($title, $message,$senior->id));
}

function leadTransfer($leadmobile = null, $seniorid = null, $leadid = null, $sales_type=null, $title=null)
{
    $senior = User::find($seniorid);
    $title = $title != null ?? 'Lead Created';
    $message = "with mobile {$leadmobile} and assigned to {$sales_type} name {$senior->name} mobile {$senior->mobile}";
    $message = LeadHistory::create(['leadid' => $leadid, 'description' => $message,'title'=>$title,'commentedby'=>auth()->user()->id]);
    $senior->notify(new NewUserRegisteration('New lead assigned', "New Lead assigned",$seniorid));
}

function leadHistoryMessageSeniorMarketingAssignment($leadmobile = null, $seniorid = null, $leadid = null, $sales_type=null)
{
    $senior = User::find($seniorid);
    $message = "with mobile {$leadmobile} and assigned to {$sales_type} name {$senior->name} mobile {$senior->mobile}";
    $message = LeadHistory::create(['leadid' => $leadid, 'description' => $message,'title'=>'Lead Created','commentedby'=>auth()->user()->id]);
}

function leadHistoryJuniorMarketingAssignment($fromassign, $toassign, $leadid)
{
    $fromuser = User::find($fromassign);
    $touser = User::find($toassign);
    $from = roleDetails($fromuser->department, $fromuser->role);
    $to = roleDetails($touser->department, $touser->role);
    $message = "by {$from} {$fromuser->name} to {$to} {$touser->name}";
    $message = LeadHistory::create(['leadid' => $leadid, 'description' => $message,'title'=>'Lead Transfered','commentedby'=>auth()->user()->id]);
}

function demoschedulelead($byuser, $demoid, $leadid)
{
    $fromuser = User::find($byuser);
    $demo = Demo::find($demoid);
    $slot = $demo->slotRelation;
    $date = $demo->date;
    $message = "Demo of this lead is schduled by {$fromuser->name} to happen from {$slot->from} to {$slot->to} at {$date} ";
    $message = LeadHistory::create(['leadid' => $leadid, 'description' => $message,'title'=>'Demo Schedule','commentedby'=>auth()->user()->id]);
}
function demoreschedulelead($byuser, $demoid, $leadid)
{
    $fromuser = User::find($byuser);
    $demo = Demo::find($demoid);
    $slot = $demo->slotRelation;
    $date = $demo->date;
    $message = "Demo of this lead is reschduled by {$fromuser->name} to happen from {$slot->from} to {$slot->to} at {$date} ";
    $message = LeadHistory::create(['leadid' => $leadid, 'description' => $message,'title'=>'Demo Reschedule','commentedby'=>auth()->user()->id]);
}

function leadHistoryJuniorMarketingtoSeniorTrainerAssignment($fromassign, $toassign, $leadid)
{
    $fromuser = User::find($fromassign);
    $touser = User::find($toassign);
    $message = "Lead transfered by junior marketing {$fromuser->name} to senior trainer {$touser->name}";
    $message = LeadHistory::create(['leadid' => $leadid, 'description' => $message,'title'=>'Transfered','commentedby'=>auth()->user()->id]);
}

function leadHistorySeniorTrainertoJuniorTrainerAssignment($fromassign, $toassign, $leadid)
{
    $fromuser = User::find($fromassign);
    $touser = User::find($toassign);
    $message = "Assigned to trainer by senior trainer {$fromuser->name} to junior trainer {$touser->name}";
    $message = LeadHistory::create(['leadid' => $leadid, 'description' => $message,'title'=>'Transfered','commentedby'=>auth()->user()->id]);
}

function leadHistorycomment($message,$leadid){
    LeadHistory::create(['leadid' => $leadid, 'description' => $message,'historytype'=>1,'title'=>'Comment','commentedby'=>auth()->user()->id]);
}

function leadHistorytrainerfeedback($leadid){
    $name=auth()->user()->name;
    $message="FeedBack is submitted by {$name} for this demo";
    LeadHistory::create(['leadid' => $leadid, 'description' => $message,'historytype'=>1,'title'=>'Comment','commentedby'=>auth()->user()->id]);
}

function fatheroccupationHelper(){
    return ['Business','Govt Job','Private Job','Farmer','Doctor'];
}

function dropreasonHelper(){
    return ['Client did not respond.','Client is willing to reschedule.','Client joined left  in between.'];
}

function courseHelper(){
    return Courses::where('isactive',1)->get();
}

function personalCourses(){
    return Courses::where(['isactive'=>'1', 'course_type'=>'1'])->get();
}

function langarray(){
    return [
        0=>'English',
        1=>'Hindi'
    ];
}

/**
 * @param route name
 * @return response
 */
function activeClass($route)
{
    return request()->segment(count(request()->segments())) == $route ? "activeClass" : '';
    
}
function headLessComponent()
{
    $navLessPages = ['demo-class'];
    $lastSegment = request()->segment(count(request()->segments()));
    return in_array($lastSegment,$navLessPages);
}
function declineRoutes()
{
    $footerLessPages = ['forgotpassword','register','login','demo-class'];
    $lastSegment = request()->segment(count(request()->segments()));
    return in_array($lastSegment,$footerLessPages);
}
function dateformater($date){
    $date=date_create($date);
    return date_format($date,"d-m-Y");
}

function timeformater($date){
    $date=date_create($date);
    return date_format($date,"H:i:s");
}

function messageforgodmodelead($detail){
    try {
       return $message=   "Assigned to {$detail->userAssignedTo->name} {$detail->userAssignedTo->mobile} on {$detail->created_at}";
    } catch (\Throwable $th) {
       return $message="Details Not Available at the moment";
    }
   
}


function userHelper($item){
    try {
       $id= optional(optional(optional($item->userRelation)->seniorTrainerRelation))->assignedto ;
       return User::findorFail($id)->name;
    } catch (\Throwable $th) {
        return '';
    }
    
}


function openfileonline($file){
    try {
        $reversedstring=$file->file;
        $fileext=explode(".",$reversedstring)[1];
        $surl=Storage::disk('public')->url($reversedstring);
        if ($fileext=='xlsx' || $fileext=='ppt' || $fileext=='docx' || $fileext == 'doc' || $fileext == 'pptx') {
            $url= "https://view.officeapps.live.com/op/embed.aspx?src={$surl}&embedded=true";
            return $url;
        }else{
            return $surl;
        }
        
    } catch (\Throwable $th) {
       return '';
    }
   
}

    /**
     * add class active in side menu bar
     * 
     * @param url name 
     * @param type (for image or for a tag ) default a tag
     * @return response
     */
    function activeTab($tab, $type='anchor')
    {
        $url = request()->segment(count(request()->segments()));
        $active = $type == 'anchor' ? 'active' : 'blue';
        $inactive = $type == 'anchor' ? 'inactive' : 'black';
        return ($url == $tab) ? $active : $inactive;
    }

    /**
     * active second last part of url
     * @param urlname
     * @return response
     */
    function active($tab)
    {
        return Request::segment(2) == $tab ? 'active':'inactive';
    }
    
    /**
     * check sub tab exists in last segment then active
     */
    function activeTabs($arr)
    {
        return in_array(Request::segment(2), $arr) ? 'active' : 'inactive';
    }

    /**
     * pagination helpers
     * 
     * @return array
     */
    function pages()
    {
        return [
            5, 10, 25, 50, 100
        ];
    }

    /**
     * options of questions
     * 
     * @return array
     */
    function optionHelper()
    {
        return [
            'a'=>'Option A' , 'b'=>'Option B', 'c'=>'Option C', 'd'=>'Option D'
        ];
    }

    /**
     * All type of classes
     * 
     * @return array
     */
    function classHelper()
    {
        return [
            // '1'=>'Class 1', 
            // '2'=>'Class 2', 
            '3'=>'Class 3', 
            '4'=>'Class 4',
            '5'=>'Class 5',
            '6'=>'Class 6',
            '7'=>'Class 7',
            '8'=>'Class 8',
            '9'=>'Class 9',
            '10'=>'Class 10',
            '11'=>'Class 11',
            '12'=>'Class 12',
        ];
    }

    /**
     * Leave type
     */
    function leaveType()
    {
        return[
            'Paid Leave',
            'Unpaid Leave'
        ];
    }

    /**
     * Leave type
     */
    function leaveFor()
    {
        return[
            'Part Time',
            'Full Time'
        ];
    }
    
    /*
     * convert seconds to hours and minutes 
     * 
     * @param $duration seconds 
     * @return response (hours:minutes:seconds)
     */
    function durationHelper($timer)
    {
        return date('M d, Y')." $timer";
        // dd($duration);
        // $start_time = explode(':', $duration);
        // $duration = ($start_time[0]*3600) + ($start_time[1]*60) + ($start_time[2]) ;

        // return $duration;
    }


    /**
     * calculate duration in seconds
     * 
     * @param start_time
     * @param end_time
     * @return response (duration)
     */
    function calculateDuration($startTime, $endTime){
        $start_time = strtotime($startTime);
        $end_time = strtotime($endTime);
        $duration = $end_time - $start_time;
        
        return gmdate('H:i:s', $duration);
    }

    /**
     * Get all departments 
     * 
     * @return response (object)
     */
    function department()
    {
        return Department::where('title','!=','Administrator')->get();
    }

    /**
     * Get all sub departments 
     * @param int department_id
     * @return response (object)
     */
    function sub_department($id)
    {
        return SubDepartment::where(['departments_id'=>$id, 'is_active'=>'1'])->select('id','name')->get();
    }

    /**
     * get details of specific user
     * 
     * @param int id
     * @return response (username)
     */
    function userName($userid=null)
    {
        $data = User::find($userid);
        return $data ? ucwords($data->name) : "N/A";
    }

    /**
     * user other details
     * 
     * @param int userid
     * @param string field
     * @param string other fields details such as school, state cities
     * @return response
     */
    function parentDetails($userid, $field, $other=null)
    {
        $data = ParentsDetail::where('user_id',$userid)->first();
        if ($data != null) {
            if ($other==null) {
                return ucwords($data->$field);
            }else {
                return $data->$other->$field ?? 'N/A';
            }
        }else {
            return 'N/A';
        }
    }

    /**
     * return user details
     * 
     * @param userid
     * @param field
     * @return response
     */
    function userDetails($userid, $field)
    {
        $user = UserDetail::where('user_id',$userid)->first();
        return $user ? $user->$field : 'N/A';
    }

    /**
     * Type of course personal and group
     */
    function courseType()
    {
        return[
            'Group Course',
            'Personal Course'
        ];
    }

    /**
     * get user's role details
     * 
     * =========================================
     *  Do not interrput the array 
     *  0 index for ceo panel
     *  1 index for admin panel
     * ========================================
     * 
     * @param int departmentid
     * @return array senior&junior
     */
    function rolesofusers($departmentid)
    {
        switch ($departmentid) {
            case 1:
                return [
                    2=>'BDM Team Lead',
                    3=>'BDE Junior'
                ];
                break;
            
            case 2:
                return [
                    2=>'BDE Team Lead',
                    3=>'BDE Intern'
                ];
                break;
            
            case 3:
                return [
                    2=>'Demo Manager',
                    3=>'Demo Tranner'
                ];
                break;

            case 4:
                return [
                    2=>'Quality Assurance',
                    3=>'Class Tranner'
                ];
                break;
            
            default:
                return [
                    2=>'Senior',
                    3=>'Junior'
                ];
                break;
        }
    }

    /**
     * get role details
     *
     * 
     * @param int departmentid
     * @param int role
     * @return array senior&junior
     */
    function roleDetails($departmentid, $roleid)
    {
        switch ($departmentid) {
            case 1:
                if ($roleid==2) {
                    return 'BDE Team Lead';
                    break;
                }else {
                    return 'BDE Intern';
                    break;
                }
                
            case 2:
                if ($roleid==2) {
                    return 'BDM Team Lead';
                    break;
                }else {
                    return 'BDE Junior';
                    break;
                }
            
            case 3:
                if ($roleid==2) {
                    return 'Demo Manager';
                    break;
                }else {
                    return 'Demo Tranner';
                    break;
                }

            case 4:
                if ($roleid==2) {
                    return 'Quality Assurance';
                    break;
                }else {
                    return 'Class Tranner';
                    break;
                }
            
            default:
                if ($roleid==2) {
                    return 'Senior';
                    break;
                }else {
                    return 'Junior';
                    break;
                }
        }
    }

    function classType()
    {
        return [
            'Demo Class',
            'Personal Class',
            'Group Class'
        ];
    }

    function getLastTwelveMonth()
    {
        $data = array();
        for ($i = 11; $i >= 0; $i--) {
            $key = Carbon::today()->startOfMonth()->subMonth($i)->format('Y-m');
            $month = Carbon::today()->startOfMonth()->subMonth($i);
            $year = Carbon::today()->startOfMonth()->subMonth($i)->format('Y');
            $data[$key] = "$month->shortMonthName, $year";
        }
        return $data;
    }

    /**
     * formate slots in 12 hour formate
     * 
     * @param object
     * @return reponse
     */
    function slotHelper($item=null)
    {
        $from = $item->slotRelation != null ? date("g:iA",strtotime(optional($item->slotRelation)->from)) ?? '' : 'N/A' ;
        $dash = $item->slotRelation != null ? '-' :'';
        $to = $item->slotRelation != null ? date("g:iA",strtotime(optional($item->slotRelation)->to)) ?? '' : '';
        return "$from $dash $to";
    }

    /**
     * Get Slots details from slot id
     * 
     * @param slotid
     * @return response (time)
     */
    function slotDetails($slotid=null)
    {
        $slot = Slot::find($slotid);
        if ($slot) {
            $from = date("g:iA",strtotime($slot->from));
            $to = date("g:iA",strtotime($slot->to));
            return "$from - $to";
        }else {
            return 'N/A';
        }
    }

    /**
     * get last date of course
     * 
     * @param startdate
     * @param duration
     * @return response
     */
    function courseLastDate($startDate, $duration=null){
        return Carbon::parse($startDate)->addDays($duration ?? 30)->format('d-m-Y');
    }

    /**
     * return dashed border
     * 
     */
    function borderDashed()
    {
        return(
            '<div class="flex flex-col md:flex-row container md:h-auto h-32 w-10/12 mx-auto">
                <div class="border-8 rounded-full border-gray-600 bg-gray-600 m-auto"></div>
                <div class="border-2 md:w-64 border-dashed border-gray-400 flex  h-28 md:h-0 m-auto"></div>
                <div class="border-8 rounded-full border-gray-600 bg-gray-600 m-auto"></div>
            </div>'
        );
    }


    /**
     * After dmeo done lead transfer to BDM TL
     *
     *  @param $leadid
     *  @param $demoid
     */
    function assignLeadToBDM($leadid, $demoid)
    {
        $assignDate=  date('Y-m-d');

        // get all BDM Teamlead
        $demomanager=User::where(['department'=>'3','sub_department'=>'1','role'=>'2','user_type'=>'1'])->pluck('id')->toArray();

        $assignedto=0; 

        // get last created lead 
        $lastassignment=LeadStatus::where(['department'=>'3', 'sub_department'=>'1', 'level'=>'5'])->latest()->first();
        


        // get lead details from demo trainer's table
        $leadstatus = LeadStatus::where(['leadid'=>$leadid, 'department'=>'4', 'sub_department'=>'3', 'level'=>'4'])->first();
        
        // update lead status in demo manager and demo trainer panel 
        if ($leadstatus) {
            $leadstatus->update(['is_transferred'=>'1']);
        }


        if ($lastassignment) {
            // get last assigned BDM id 
            $lastleadassignedto=LeadStatus::where(['department'=>'3', 'sub_department'=>'1', 'level'=>'5'])->latest()->first()->assignedto;
            $key = array_search($lastleadassignedto, $demomanager);
            $lastindex=count($demomanager)-1;

            // if senior sale is last from rows then assign to first senior sales
            if ($lastindex == $key) {
                $assignedto=$demomanager[0];
            }else{
                $assignedto=$demomanager[$key+1];
            }
            
        }else{
            
            // if last created lead is null then assign lead to first senior sales 
            $sesiorsales=User::where(['department'=>'3', 'sub_department'=>'1', 'role'=>'2'])->first();
            
            if ($sesiorsales) {
                $assignedto=$sesiorsales->id;
            }
        }

        // get demo trainer details  for assigned by role
        $leadstatus = LeadStatus::where(['leadid'=>$leadid, 'department'=>'4', 'sub_department'=>'3', 'level'=>'4'])->first();
        
        if ($leadstatus) {
            $assignedBy = $leadstatus->assignedto;
            $comments = $leadstatus->assignedto;
        }
        $alreadyExists = LeadStatus::where(['leadid'=>$leadid,'assignedby'=>$assignedBy,'assignedto'=>$assignedto, 'leadtype'=>'1','department'=>'3', 'sub_department'=>'1', 'level'=>'5','demoid'=>$demoid])->exists();

        if (!$alreadyExists) {
            LeadStatus::create(['leadid'=>$leadid,'assignedby'=>$assignedBy,'assignedto'=>$assignedto, 'assign_date'=>$assignDate,'leadtype'=>'1','department'=>'3', 'sub_department'=>'1', 'level'=>'5','comments'=>'Lead transfer from Demo Trainer to BDM Team Lead','demoid'=>$demoid]);

            $leadDetails = User::find($leadid);
            if ($leadDetails != null) {
                leadTransfer($leadDetails->mobile, $assignedto, $leadid, "BDM Team Lead");
            }
            
        }
        // leadHistoryMessageSeniorMarketingAssignment(auth()->user()->mobile, $assignedto, auth()->user()->id, 'BDM TL');

    }