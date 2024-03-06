<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            [
                'states_id'=>1,
                'name'=>'ANANTNAG'
            ] ,        
            [
                'states_id'=>1,
                'name'=>'Budgam'
            ] ,        
            [
                'states_id'=>1,
                'name'=>'BARAMULLA'
            ] ,        
            [
                'states_id'=>1,
                'name'=>'DODA'
            ] ,        
            [
                'states_id'=>1,
                'name'=>'JAMMU'
            ] ,        
            [
                'states_id'=>37,
                'name'=>'KARGIL'
            ] ,        
            [
                'states_id'=>1,
                'name'=>'KATHUA'
            ] ,        
            [
                'states_id'=>1,
                'name'=>'KUPWARA'
            ] ,        
            [
                'states_id'=>37,
                'name'=>'LEH LADAKH'
            ] ,        
            [
                'states_id'=>1,
                'name'=>'POONCH'
            ] ,        
            [
                'states_id'=>1,
                'name'=>'PULWAMA'
            ] ,        
            [
                'states_id'=>1,
                'name'=>'RAJOURI'
            ] ,        
            [
                'states_id'=>1,
                'name'=>'SRINAGAR'
            ] ,        
            [
                'states_id'=>1,
                'name'=>'UDHAMPUR'
            ] ,        
            [
                'states_id'=>2,
                'name'=>'BILASPUR'
            ] ,        
            [
                'states_id'=>2,
                'name'=>'CHAMBA'
            ] ,        
            [
                'states_id'=>2,
                'name'=>'HAMIRPUR'
            ] ,        
            [
                'states_id'=>2,
                'name'=>'KANGRA'
            ] ,        
            [
                'states_id'=>2,
                'name'=>'KINNAUR'
            ] ,        
            [
                'states_id'=>2,
                'name'=>'KULLU'
            ] ,        
            [
                'states_id'=>2,
                'name'=>'LAHUL AND S'
            ] ,        
            [
                'states_id'=>2,
                'name'=>'MANDI'
            ] ,        
            [
                'states_id'=>2,
                'name'=>'SHIMLA'
            ] ,        
            [
                'states_id'=>2,
                'name'=>'SIRMAUR'
            ] ,        
            [
                'states_id'=>2,
                'name'=>'SOLAN'
            ] ,        
            [
                'states_id'=>2,
                'name'=>'UNA'
            ] ,        
            [
                'states_id'=>3,
                'name'=>'AMRITSAR'
            ] ,        
            [
                'states_id'=>3,
                'name'=>'BATHINDA'
            ] ,        
            [
                'states_id'=>3,
                'name'=>'FARIDKOT'
            ] ,        
            [
                'states_id'=>3,
                'name'=>'FATEHGARH S'
            ] ,        
            [
                'states_id'=>3,
                'name'=>'FIROZEPUR'
            ] ,        
            [
                'states_id'=>3,
                'name'=>'GURDASPUR'
            ] ,        
            [
                'states_id'=>3,
                'name'=>'HOSHIARPUR'
            ] ,        
            [
                'states_id'=>3,
                'name'=>'JALANDHAR'
            ] ,        
            [
                'states_id'=>3,
                'name'=>'KAPURTHALA'
            ] ,        
            [
                'states_id'=>3,
                'name'=>'LUDHIANA'
            ] ,        
            [
                'states_id'=>3,
                'name'=>'MANSA'
            ] ,        
            [
                'states_id'=>3,
                'name'=>'MOGA'
            ] ,        
            [
                'states_id'=>3,
                'name'=>'SRI MUKTSAR'
            ] ,        
            [
                'states_id'=>3,
                'name'=>'Shahid Bhag'
            ] ,        
            [
                'states_id'=>3,
                'name'=>'PATIALA'
            ] ,        
            [
                'states_id'=>3,
                'name'=>'RUPNAGAR'
            ] ,        
            [
                'states_id'=>3,
                'name'=>'SANGRUR'
            ] ,        
            [
                'states_id'=>4,
                'name'=>'CHANDIGARH'
            ] ,        
            [
                'states_id'=>5,
                'name'=>'ALMORA'
            ] ,        
            [
                'states_id'=>5,
                'name'=>'BAGESHWAR'
            ] ,        
            [
                'states_id'=>5,
                'name'=>'CHAMOLI'
            ] ,        
            [
                'states_id'=>5,
                'name'=>'CHAMPAWAT'
            ] ,        
            [
                'states_id'=>5,
                'name'=>'DEHRADUN'
            ] ,        
            [
                'states_id'=>5,
                'name'=>'HARIDWAR'
            ] ,        
            [
                'states_id'=>5,
                'name'=>'NAINITAL'
            ] ,        
            [
                'states_id'=>5,
                'name'=>'PAURI GARHW'
            ] ,        
            [
                'states_id'=>5,
                'name'=>'PITHORAGARH'
            ] ,        
            [
                'states_id'=>5,
                'name'=>'RUDRA PRAYA'
            ] ,        
            [
                'states_id'=>5,
                'name'=>'TEHRI GARHW'
            ] ,        
            [
                'states_id'=>5,
                'name'=>'UDAM SINGH '
            ] ,        
            [
                'states_id'=>5,
                'name'=>'UTTAR KASHI'
            ] ,        
            [
                'states_id'=>6,
                'name'=>'AMBALA'
            ] ,        
            [
                'states_id'=>6,
                'name'=>'BHIWANI'
            ] ,        
            [
                'states_id'=>6,
                'name'=>'FARIDABAD'
            ] ,        
            [
                'states_id'=>6,
                'name'=>'FATEHABAD'
            ] ,        
            [
                'states_id'=>6,
                'name'=>'GURUGRAM'
            ] ,        
            [
                'states_id'=>6,
                'name'=>'HISAR'
            ] ,        
            [
                'states_id'=>6,
                'name'=>'JHAJJAR'
            ] ,        
            [
                'states_id'=>6,
                'name'=>'JIND'
            ] ,        
            [
                'states_id'=>6,
                'name'=>'KAITHAL'
            ] ,        
            [
                'states_id'=>6,
                'name'=>'KARNAL'
            ] ,        
            [
                'states_id'=>6,
                'name'=>'KURUKSHETRA'
            ] ,        
            [
                'states_id'=>6,
                'name'=>'MAHENDRAGAR'
            ] ,        
            [
                'states_id'=>6,
                'name'=>'PANCHKULA'
            ] ,        
            [
                'states_id'=>6,
                'name'=>'PANIPAT'
            ] ,        
            [
                'states_id'=>6,
                'name'=>'REWARI'
            ] ,        
            [
                'states_id'=>6,
                'name'=>'ROHTAK'
            ] ,        
            [
                'states_id'=>6,
                'name'=>'SIRSA'
            ] ,        
            [
                'states_id'=>6,
                'name'=>'SONIPAT'
            ] ,        
            [
                'states_id'=>6,
                'name'=>'YAMUNANAGAR'
            ] ,        
            [
                'states_id'=>7,
                'name'=>'CENTRAL'
            ] ,        
            [
                'states_id'=>7,
                'name'=>'EAST'
            ] ,        
            [
                'states_id'=>7,
                'name'=>'NEW DELHI'
            ] ,        
            [
                'states_id'=>7,
                'name'=>'NORTH'
            ] ,        
            [
                'states_id'=>7,
                'name'=>'NORTH EAST'
            ] ,        
            [
                'states_id'=>7,
                'name'=>'NORTH WEST'
            ] ,        
            [
                'states_id'=>7,
                'name'=>'SOUTH'
            ] ,        
            [
                'states_id'=>7,
                'name'=>'SOUTH WEST'
            ] ,        
            [
                'states_id'=>7,
                'name'=>'WEST'
            ] ,        
            [
                'states_id'=>8,
                'name'=>'AJMER'
            ] ,        
            [
                'states_id'=>8,
                'name'=>'ALWAR'
            ] ,        
            [
                'states_id'=>8,
                'name'=>'BANSWARA'
            ] ,        
            [
                'states_id'=>8,
                'name'=>'BARAN'
            ] ,        
            [
                'states_id'=>8,
                'name'=>'BARMER'
            ] ,        
            [
                'states_id'=>8,
                'name'=>'BHARATPUR'
            ] ,        
            [
                'states_id'=>8,
                'name'=>'BHILWARA'
            ] ,        
            [
                'states_id'=>8,
                'name'=>'BIKANER'
            ] ,        
            [
                'states_id'=>8,
                'name'=>'BUNDI'
            ] ,        
            [
                'states_id'=>8,
                'name'=>'CHITTORGARH'
            ] ,        
            [
                'states_id'=>8,
                'name'=>'CHURU'
            ] ,        
            [
                'states_id'=>8,
                'name'=>'DAUSA'
            ] ,        
            [
                'states_id'=>8,
                'name'=>'DHOLPUR'
            ] ,        
            [
                'states_id'=>8,
                'name'=>'DUNGARPUR'
            ] ,        
            [
                'states_id'=>8,
                'name'=>'GANGANAGAR'
            ] ,        
            [
                'states_id'=>8,
                'name'=>'HANUMANGARH'
            ] ,        
            [
                'states_id'=>8,
                'name'=>'JAIPUR'
            ] ,        
            [
                'states_id'=>8,
                'name'=>'JAISALMER'
            ] ,        
            [
                'states_id'=>8,
                'name'=>'JALORE'
            ] ,        
            [
                'states_id'=>8,
                'name'=>'JHALAWAR'
            ] ,        
            [
                'states_id'=>8,
                'name'=>'JHUNJHUNU'
            ] ,        
            [
                'states_id'=>8,
                'name'=>'JODHPUR'
            ] ,        
            [
                'states_id'=>8,
                'name'=>'KARAULI'
            ] ,        
            [
                'states_id'=>8,
                'name'=>'KOTA'
            ] ,        
            [
                'states_id'=>8,
                'name'=>'NAGAUR'
            ] ,        
            [
                'states_id'=>8,
                'name'=>'PALI'
            ] ,        
            [
                'states_id'=>8,
                'name'=>'RAJSAMAND'
            ] ,        
            [
                'states_id'=>8,
                'name'=>'SAWAI MADHO'
            ] ,        
            [
                'states_id'=>8,
                'name'=>'SIKAR'
            ] ,        
            [
                'states_id'=>8,
                'name'=>'SIROHI'
            ] ,        
            [
                'states_id'=>8,
                'name'=>'TONK'
            ] ,        
            [
                'states_id'=>8,
                'name'=>'UDAIPUR'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'AGRA'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'ALIGARH'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'PRAYAGRAJ'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'AMBEDKAR NA'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'AURAIYA'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'AZAMGARH'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'BAGHPAT'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'BAHRAICH'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'BALLIA'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'BALRAMPUR'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'BANDA'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'BARABANKI'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'BAREILLY'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'BASTI'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'BIJNOR'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'BUDAUN'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'BULANDSHAHR'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'CHANDAULI'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'CHITRAKOOT'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'DEORIA'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'ETAH'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'ETAWAH'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'FAIZABAD'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'FARRUKHABAD'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'FATEHPUR'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'FIROZABAD'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'GAUTAM BUDD'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'GHAZIABAD'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'GHAZIPUR'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'GONDA'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'GORAKHPUR'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'HAMIRPUR'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'HARDOI'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'JALAUN'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'JAUNPUR'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'JHANSI'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'AMROHA'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'KANNAUJ'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'KANPUR DEHA'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'KANPUR NAGA'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'KAUSHAMBI'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'KHERI'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'KUSHI NAGAR'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'LALITPUR'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'LUCKNOW'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'HATHRAS'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'MAHARAJGANJ'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'MAHOBA'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'MAINPURI'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'MATHURA'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'MAU'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'MEERUT'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'MIRZAPUR'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'MORADABAD'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'MUZAFFARNAG'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'PILIBHIT'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'PRATAPGARH'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'RAE BARELI'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'RAMPUR'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'SAHARANPUR'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'SANT KABEER'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'BHADOHI'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'SHAHJAHANPU'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'SHRAVASTI'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'SIDDHARTH N'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'SITAPUR'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'SONBHADRA'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'SULTANPUR'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'UNNAO'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'VARANASI'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'ARARIA'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'AURANGABAD'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'BANKA'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'BEGUSARAI'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'BHAGALPUR'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'BHOJPUR'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'BUXAR'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'DARBHANGA'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'GAYA'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'GOPALGANJ'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'JAMUI'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'JEHANABAD'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'KAIMUR (BHA'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'KATIHAR'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'KHAGARIA'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'KISHANGANJ'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'LAKHISARAI'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'MADHEPURA'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'MADHUBANI'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'MUNGER'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'MUZAFFARPUR'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'NALANDA'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'NAWADA'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'PASHCHIM CH'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'PATNA'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'PURBI CHAMP'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'PURNIA'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'ROHTAS'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'SAHARSA'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'SAMASTIPUR'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'SARAN'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'SHEIKHPURA'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'SHEOHAR'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'SITAMARHI'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'SIWAN'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'SUPAUL'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'VAISHALI'
            ] ,        
            [
                'states_id'=>11,
                'name'=>'EAST DISTRI'
            ] ,        
            [
                'states_id'=>11,
                'name'=>'NORTH DISTR'
            ] ,        
            [
                'states_id'=>11,
                'name'=>'SOUTH DISTR'
            ] ,        
            [
                'states_id'=>11,
                'name'=>'WEST DISTRI'
            ] ,        
            [
                'states_id'=>12,
                'name'=>'CHANGLANG'
            ] ,        
            [
                'states_id'=>12,
                'name'=>'DIBANG VALL'
            ] ,        
            [
                'states_id'=>12,
                'name'=>'EAST KAMENG'
            ] ,        
            [
                'states_id'=>12,
                'name'=>'EAST SIANG'
            ] ,        
            [
                'states_id'=>12,
                'name'=>'KURUNG KUME'
            ] ,        
            [
                'states_id'=>12,
                'name'=>'LOHIT'
            ] ,        
            [
                'states_id'=>12,
                'name'=>'LOWER DIBAN'
            ] ,        
            [
                'states_id'=>12,
                'name'=>'LOWER SUBAN'
            ] ,        
            [
                'states_id'=>12,
                'name'=>'PAPUM PARE'
            ] ,        
            [
                'states_id'=>12,
                'name'=>'TAWANG'
            ] ,        
            [
                'states_id'=>12,
                'name'=>'TIRAP'
            ] ,        
            [
                'states_id'=>12,
                'name'=>'UPPER SIANG'
            ] ,        
            [
                'states_id'=>12,
                'name'=>'UPPER SUBAN'
            ] ,        
            [
                'states_id'=>12,
                'name'=>'WEST KAMENG'
            ] ,        
            [
                'states_id'=>12,
                'name'=>'WEST SIANG'
            ] ,        
            [
                'states_id'=>13,
                'name'=>'DIMAPUR'
            ] ,        
            [
                'states_id'=>13,
                'name'=>'KOHIMA'
            ] ,        
            [
                'states_id'=>13,
                'name'=>'MOKOKCHUNG'
            ] ,        
            [
                'states_id'=>13,
                'name'=>'MON'
            ] ,        
            [
                'states_id'=>13,
                'name'=>'PHEK'
            ] ,        
            [
                'states_id'=>13,
                'name'=>'TUENSANG'
            ] ,        
            [
                'states_id'=>13,
                'name'=>'WOKHA'
            ] ,        
            [
                'states_id'=>13,
                'name'=>'ZUNHEBOTO'
            ] ,        
            [
                'states_id'=>14,
                'name'=>'BISHNUPUR'
            ] ,        
            [
                'states_id'=>14,
                'name'=>'CHANDEL'
            ] ,        
            [
                'states_id'=>14,
                'name'=>'CHURACHANDP'
            ] ,        
            [
                'states_id'=>14,
                'name'=>'IMPHAL EAST'
            ] ,        
            [
                'states_id'=>14,
                'name'=>'IMPHAL WEST'
            ] ,        
            [
                'states_id'=>14,
                'name'=>'SENAPATI'
            ] ,        
            [
                'states_id'=>14,
                'name'=>'TAMENGLONG'
            ] ,        
            [
                'states_id'=>14,
                'name'=>'THOUBAL'
            ] ,        
            [
                'states_id'=>14,
                'name'=>'UKHRUL'
            ] ,        
            [
                'states_id'=>15,
                'name'=>'AIZAWL'
            ] ,        
            [
                'states_id'=>15,
                'name'=>'CHAMPHAI'
            ] ,        
            [
                'states_id'=>15,
                'name'=>'KOLASIB'
            ] ,        
            [
                'states_id'=>15,
                'name'=>'LAWNGTLAI'
            ] ,        
            [
                'states_id'=>15,
                'name'=>'LUNGLEI'
            ] ,        
            [
                'states_id'=>15,
                'name'=>'MAMIT'
            ] ,        
            [
                'states_id'=>15,
                'name'=>'SAIHA'
            ] ,        
            [
                'states_id'=>15,
                'name'=>'SERCHHIP'
            ] ,        
            [
                'states_id'=>16,
                'name'=>'Dhalai'
            ] ,        
            [
                'states_id'=>16,
                'name'=>'North Tripu'
            ] ,        
            [
                'states_id'=>16,
                'name'=>'South Tripu'
            ] ,        
            [
                'states_id'=>16,
                'name'=>'West Tripur'
            ] ,        
            [
                'states_id'=>17,
                'name'=>'EAST GARO H'
            ] ,        
            [
                'states_id'=>17,
                'name'=>'EAST KHASI '
            ] ,        
            [
                'states_id'=>17,
                'name'=>'WEST JAINTI'
            ] ,        
            [
                'states_id'=>17,
                'name'=>'RI BHOI'
            ] ,        
            [
                'states_id'=>17,
                'name'=>'SOUTH GARO '
            ] ,        
            [
                'states_id'=>17,
                'name'=>'WEST GARO H'
            ] ,        
            [
                'states_id'=>17,
                'name'=>'WEST KHASI '
            ] ,        
            [
                'states_id'=>18,
                'name'=>'BARPETA'
            ] ,        
            [
                'states_id'=>18,
                'name'=>'BONGAIGAON'
            ] ,        
            [
                'states_id'=>18,
                'name'=>'CACHAR'
            ] ,        
            [
                'states_id'=>18,
                'name'=>'DARRANG'
            ] ,        
            [
                'states_id'=>18,
                'name'=>'DHEMAJI'
            ] ,        
            [
                'states_id'=>18,
                'name'=>'DHUBRI'
            ] ,        
            [
                'states_id'=>18,
                'name'=>'DIBRUGARH'
            ] ,        
            [
                'states_id'=>18,
                'name'=>'GOALPARA'
            ] ,        
            [
                'states_id'=>18,
                'name'=>'GOLAGHAT'
            ] ,        
            [
                'states_id'=>18,
                'name'=>'HAILAKANDI'
            ] ,        
            [
                'states_id'=>18,
                'name'=>'JORHAT'
            ] ,        
            [
                'states_id'=>18,
                'name'=>'KAMRUP'
            ] ,        
            [
                'states_id'=>18,
                'name'=>'KARBI ANGLO'
            ] ,        
            [
                'states_id'=>18,
                'name'=>'KARIMGANJ'
            ] ,        
            [
                'states_id'=>18,
                'name'=>'KOKRAJHAR'
            ] ,        
            [
                'states_id'=>18,
                'name'=>'LAKHIMPUR'
            ] ,        
            [
                'states_id'=>18,
                'name'=>'MARIGAON'
            ] ,        
            [
                'states_id'=>18,
                'name'=>'NAGAON'
            ] ,        
            [
                'states_id'=>18,
                'name'=>'NALBARI'
            ] ,        
            [
                'states_id'=>18,
                'name'=>'DIMA HASAO'
            ] ,        
            [
                'states_id'=>18,
                'name'=>'SIVASAGAR'
            ] ,        
            [
                'states_id'=>18,
                'name'=>'SONITPUR'
            ] ,        
            [
                'states_id'=>18,
                'name'=>'TINSUKIA'
            ] ,        
            [
                'states_id'=>19,
                'name'=>'24 PARAGANA'
            ] ,        
            [
                'states_id'=>19,
                'name'=>'24 PARAGANA'
            ] ,        
            [
                'states_id'=>19,
                'name'=>'BANKURA'
            ] ,        
            [
                'states_id'=>19,
                'name'=>'PURBA BARDH'
            ] ,        
            [
                'states_id'=>19,
                'name'=>'BIRBHUM'
            ] ,        
            [
                'states_id'=>19,
                'name'=>'COOCHBEHAR'
            ] ,        
            [
                'states_id'=>19,
                'name'=>'DARJEELING'
            ] ,        
            [
                'states_id'=>19,
                'name'=>'DINAJPUR DA'
            ] ,        
            [
                'states_id'=>19,
                'name'=>'DINAJPUR UT'
            ] ,        
            [
                'states_id'=>19,
                'name'=>'HOOGHLY'
            ] ,        
            [
                'states_id'=>19,
                'name'=>'HOWRAH'
            ] ,        
            [
                'states_id'=>19,
                'name'=>'JALPAIGURI'
            ] ,        
            [
                'states_id'=>19,
                'name'=>'KOLKATA'
            ] ,        
            [
                'states_id'=>19,
                'name'=>'MALDAH'
            ] ,        
            [
                'states_id'=>19,
                'name'=>'MEDINIPUR E'
            ] ,        
            [
                'states_id'=>19,
                'name'=>'MEDINIPUR W'
            ] ,        
            [
                'states_id'=>19,
                'name'=>'MURSHIDABAD'
            ] ,        
            [
                'states_id'=>19,
                'name'=>'NADIA'
            ] ,        
            [
                'states_id'=>19,
                'name'=>'PURULIA'
            ] ,        
            [
                'states_id'=>20,
                'name'=>'BOKARO'
            ] ,        
            [
                'states_id'=>20,
                'name'=>'CHATRA'
            ] ,        
            [
                'states_id'=>20,
                'name'=>'DEOGHAR'
            ] ,        
            [
                'states_id'=>20,
                'name'=>'DHANBAD'
            ] ,        
            [
                'states_id'=>20,
                'name'=>'DUMKA'
            ] ,        
            [
                'states_id'=>20,
                'name'=>'EAST SINGHB'
            ] ,        
            [
                'states_id'=>20,
                'name'=>'GARHWA'
            ] ,        
            [
                'states_id'=>20,
                'name'=>'GIRIDIH'
            ] ,        
            [
                'states_id'=>20,
                'name'=>'GODDA'
            ] ,        
            [
                'states_id'=>20,
                'name'=>'GUMLA'
            ] ,        
            [
                'states_id'=>20,
                'name'=>'HAZARIBAGH'
            ] ,        
            [
                'states_id'=>20,
                'name'=>'JAMTARA'
            ] ,        
            [
                'states_id'=>20,
                'name'=>'KODERMA'
            ] ,        
            [
                'states_id'=>20,
                'name'=>'LATEHAR'
            ] ,        
            [
                'states_id'=>20,
                'name'=>'LOHARDAGA'
            ] ,        
            [
                'states_id'=>20,
                'name'=>'PAKUR'
            ] ,        
            [
                'states_id'=>20,
                'name'=>'PALAMU'
            ] ,        
            [
                'states_id'=>20,
                'name'=>'RANCHI'
            ] ,        
            [
                'states_id'=>20,
                'name'=>'SAHEBGANJ'
            ] ,        
            [
                'states_id'=>20,
                'name'=>'SARAIKELA K'
            ] ,        
            [
                'states_id'=>20,
                'name'=>'SIMDEGA'
            ] ,        
            [
                'states_id'=>20,
                'name'=>'WEST SINGHB'
            ] ,        
            [
                'states_id'=>21,
                'name'=>'ANUGUL'
            ] ,        
            [
                'states_id'=>21,
                'name'=>'BALANGIR'
            ] ,        
            [
                'states_id'=>21,
                'name'=>'BALESHWAR'
            ] ,        
            [
                'states_id'=>21,
                'name'=>'BARGARH'
            ] ,        
            [
                'states_id'=>21,
                'name'=>'BHADRAK'
            ] ,        
            [
                'states_id'=>21,
                'name'=>'BOUDH'
            ] ,        
            [
                'states_id'=>21,
                'name'=>'CUTTACK'
            ] ,        
            [
                'states_id'=>21,
                'name'=>'DEOGARH'
            ] ,        
            [
                'states_id'=>21,
                'name'=>'DHENKANAL'
            ] ,        
            [
                'states_id'=>21,
                'name'=>'GAJAPATI'
            ] ,        
            [
                'states_id'=>21,
                'name'=>'GANJAM'
            ] ,        
            [
                'states_id'=>21,
                'name'=>'JAGATSINGHA'
            ] ,        
            [
                'states_id'=>21,
                'name'=>'JAJAPUR'
            ] ,        
            [
                'states_id'=>21,
                'name'=>'JHARSUGUDA'
            ] ,        
            [
                'states_id'=>21,
                'name'=>'KALAHANDI'
            ] ,        
            [
                'states_id'=>21,
                'name'=>'KANDHAMAL'
            ] ,        
            [
                'states_id'=>21,
                'name'=>'KENDRAPARA'
            ] ,        
            [
                'states_id'=>21,
                'name'=>'KENDUJHAR'
            ] ,        
            [
                'states_id'=>21,
                'name'=>'KHORDHA'
            ] ,        
            [
                'states_id'=>21,
                'name'=>'KORAPUT'
            ] ,        
            [
                'states_id'=>21,
                'name'=>'MALKANGIRI'
            ] ,        
            [
                'states_id'=>21,
                'name'=>'MAYURBHANJ'
            ] ,        
            [
                'states_id'=>21,
                'name'=>'NABARANGPUR'
            ] ,        
            [
                'states_id'=>21,
                'name'=>'NAYAGARH'
            ] ,        
            [
                'states_id'=>21,
                'name'=>'NUAPADA'
            ] ,        
            [
                'states_id'=>21,
                'name'=>'PURI'
            ] ,        
            [
                'states_id'=>21,
                'name'=>'RAYAGADA'
            ] ,        
            [
                'states_id'=>21,
                'name'=>'SAMBALPUR'
            ] ,        
            [
                'states_id'=>21,
                'name'=>'SONEPUR'
            ] ,        
            [
                'states_id'=>21,
                'name'=>'SUNDARGARH'
            ] ,        
            [
                'states_id'=>22,
                'name'=>'BASTAR'
            ] ,        
            [
                'states_id'=>22,
                'name'=>'BILASPUR'
            ] ,        
            [
                'states_id'=>22,
                'name'=>'DANTEWADA'
            ] ,        
            [
                'states_id'=>22,
                'name'=>'DHAMTARI'
            ] ,        
            [
                'states_id'=>22,
                'name'=>'DURG'
            ] ,        
            [
                'states_id'=>22,
                'name'=>'JANJGIR-CHA'
            ] ,        
            [
                'states_id'=>22,
                'name'=>'JASHPUR'
            ] ,        
            [
                'states_id'=>22,
                'name'=>'KANKER'
            ] ,        
            [
                'states_id'=>22,
                'name'=>'KABIRDHAM'
            ] ,        
            [
                'states_id'=>22,
                'name'=>'KORBA'
            ] ,        
            [
                'states_id'=>22,
                'name'=>'KOREA'
            ] ,        
            [
                'states_id'=>22,
                'name'=>'MAHASAMUND'
            ] ,        
            [
                'states_id'=>22,
                'name'=>'RAIGARH'
            ] ,        
            [
                'states_id'=>22,
                'name'=>'RAIPUR'
            ] ,        
            [
                'states_id'=>22,
                'name'=>'RAJNANDGAON'
            ] ,        
            [
                'states_id'=>22,
                'name'=>'SURGUJA'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'ANUPPUR'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'ASHOKNAGAR'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'BALAGHAT'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'BARWANI'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'BETUL'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'BHIND'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'BHOPAL'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'BURHANPUR'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'CHHATARPUR'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'CHHINDWARA'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'DAMOH'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'DATIA'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'DEWAS'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'DHAR'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'DINDORI'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'EAST NIMAR'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'GUNA'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'GWALIOR'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'HARDA'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'HOSHANGABAD'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'INDORE'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'JABALPUR'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'JHABUA'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'KATNI'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'KHARGONE'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'MANDLA'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'MANDSAUR'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'MORENA'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'NARSINGHPUR'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'NEEMUCH'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'PANNA'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'RAISEN'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'RAJGARH'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'RATLAM'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'REWA'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'SAGAR'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'SATNA'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'SEHORE'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'SEONI'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'SHAHDOL'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'SHAJAPUR'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'SHEOPUR'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'SHIVPURI'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'SIDHI'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'TIKAMGARH'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'UJJAIN'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'UMARIA'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'VIDISHA'
            ] ,        
            [
                'states_id'=>24,
                'name'=>'AHMADABAD'
            ] ,        
            [
                'states_id'=>24,
                'name'=>'AMRELI'
            ] ,        
            [
                'states_id'=>24,
                'name'=>'ANAND'
            ] ,        
            [
                'states_id'=>24,
                'name'=>'BANAS KANTH'
            ] ,        
            [
                'states_id'=>24,
                'name'=>'BHARUCH'
            ] ,        
            [
                'states_id'=>24,
                'name'=>'BHAVNAGAR'
            ] ,        
            [
                'states_id'=>24,
                'name'=>'DANG'
            ] ,        
            [
                'states_id'=>24,
                'name'=>'DOHAD'
            ] ,        
            [
                'states_id'=>24,
                'name'=>'GANDHINAGAR'
            ] ,        
            [
                'states_id'=>24,
                'name'=>'JAMNAGAR'
            ] ,        
            [
                'states_id'=>24,
                'name'=>'JUNAGADH'
            ] ,        
            [
                'states_id'=>24,
                'name'=>'KACHCHH'
            ] ,        
            [
                'states_id'=>24,
                'name'=>'KHEDA'
            ] ,        
            [
                'states_id'=>24,
                'name'=>'MAHESANA'
            ] ,        
            [
                'states_id'=>24,
                'name'=>'NARMADA'
            ] ,        
            [
                'states_id'=>24,
                'name'=>'NAVSARI'
            ] ,        
            [
                'states_id'=>24,
                'name'=>'PANCH MAHAL'
            ] ,        
            [
                'states_id'=>24,
                'name'=>'PATAN'
            ] ,        
            [
                'states_id'=>24,
                'name'=>'PORBANDAR'
            ] ,        
            [
                'states_id'=>24,
                'name'=>'RAJKOT'
            ] ,        
            [
                'states_id'=>24,
                'name'=>'SABAR KANTH'
            ] ,        
            [
                'states_id'=>24,
                'name'=>'SURAT'
            ] ,        
            [
                'states_id'=>24,
                'name'=>'SURENDRANAG'
            ] ,        
            [
                'states_id'=>24,
                'name'=>'VADODARA'
            ] ,        
            [
                'states_id'=>24,
                'name'=>'VALSAD'
            ] ,        
            [
                'states_id'=>25,
                'name'=>'DAMAN'
            ] ,        
            [
                'states_id'=>25,
                'name'=>'DIU'
            ] ,        
            [
                'states_id'=>26,
                'name'=>'DADRA AND N'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'AHMEDNAGAR'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'AKOLA'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'AMRAVATI'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'AURANGABAD'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'BEED'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'BHANDARA'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'BULDHANA'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'CHANDRAPUR'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'DHULE'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'GADCHIROLI'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'GONDIA'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'HINGOLI'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'JALGAON'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'JALNA'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'KOLHAPUR'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'LATUR'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'MUMBAI'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'MUMBAI SUBU'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'NAGPUR'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'NANDED'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'NANDURBAR'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'NASHIK'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'OSMANABAD'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'PARBHANI'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'PUNE'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'RAIGAD'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'RATNAGIRI'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'SANGLI'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'SATARA'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'SINDHUDURG'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'SOLAPUR'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'THANE'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'WARDHA'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'WASHIM'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'YAVATMAL'
            ] ,        
            [
                'states_id'=>36,
                'name'=>'ADILABAD'
            ] ,        
            [
                'states_id'=>28,
                'name'=>'ANANTAPUR'
            ] ,        
            [
                'states_id'=>28,
                'name'=>'CHITTOOR'
            ] ,        
            [
                'states_id'=>28,
                'name'=>'Y.S.R.'
            ] ,        
            [
                'states_id'=>28,
                'name'=>'EAST GODAVA'
            ] ,        
            [
                'states_id'=>28,
                'name'=>'GUNTUR'
            ] ,        
            [
                'states_id'=>36,
                'name'=>'HYDERABAD'
            ] ,        
            [
                'states_id'=>36,
                'name'=>'KARIMNAGAR'
            ] ,        
            [
                'states_id'=>36,
                'name'=>'KHAMMAM'
            ] ,        
            [
                'states_id'=>28,
                'name'=>'KRISHNA'
            ] ,        
            [
                'states_id'=>28,
                'name'=>'KURNOOL'
            ] ,        
            [
                'states_id'=>36,
                'name'=>'MAHABUBNAGA'
            ] ,        
            [
                'states_id'=>36,
                'name'=>'MEDAK'
            ] ,        
            [
                'states_id'=>36,
                'name'=>'NALGONDA'
            ] ,        
            [
                'states_id'=>28,
                'name'=>'SPSR NELLOR'
            ] ,        
            [
                'states_id'=>36,
                'name'=>'NIZAMABAD'
            ] ,        
            [
                'states_id'=>28,
                'name'=>'PRAKASAM'
            ] ,        
            [
                'states_id'=>36,
                'name'=>'RANGA REDDY'
            ] ,        
            [
                'states_id'=>28,
                'name'=>'SRIKAKULAM'
            ] ,        
            [
                'states_id'=>28,
                'name'=>'VISAKHAPATA'
            ] ,        
            [
                'states_id'=>28,
                'name'=>'VIZIANAGARA'
            ] ,        
            [
                'states_id'=>36,
                'name'=>'WARANGAL RU'
            ] ,        
            [
                'states_id'=>28,
                'name'=>'WEST GODAVA'
            ] ,        
            [
                'states_id'=>29,
                'name'=>'BAGALKOTE'
            ] ,        
            [
                'states_id'=>29,
                'name'=>'BENGALURU U'
            ] ,        
            [
                'states_id'=>29,
                'name'=>'BENGALURU R'
            ] ,        
            [
                'states_id'=>29,
                'name'=>'BELAGAVI'
            ] ,        
            [
                'states_id'=>29,
                'name'=>'BALLARI'
            ] ,        
            [
                'states_id'=>29,
                'name'=>'BIDAR'
            ] ,        
            [
                'states_id'=>29,
                'name'=>'VIJAYAPURA'
            ] ,        
            [
                'states_id'=>29,
                'name'=>'CHAMARAJANA'
            ] ,        
            [
                'states_id'=>29,
                'name'=>'CHIKKAMAGAL'
            ] ,        
            [
                'states_id'=>29,
                'name'=>'CHITRADURGA'
            ] ,        
            [
                'states_id'=>29,
                'name'=>'DAKSHINA KA'
            ] ,        
            [
                'states_id'=>29,
                'name'=>'DAVANGERE'
            ] ,        
            [
                'states_id'=>29,
                'name'=>'DHARWAD'
            ] ,        
            [
                'states_id'=>29,
                'name'=>'GADAG'
            ] ,        
            [
                'states_id'=>29,
                'name'=>'KALABURAGI'
            ] ,        
            [
                'states_id'=>29,
                'name'=>'HASSAN'
            ] ,        
            [
                'states_id'=>29,
                'name'=>'HAVERI'
            ] ,        
            [
                'states_id'=>29,
                'name'=>'KODAGU'
            ] ,        
            [
                'states_id'=>29,
                'name'=>'KOLAR'
            ] ,        
            [
                'states_id'=>29,
                'name'=>'KOPPAL'
            ] ,        
            [
                'states_id'=>29,
                'name'=>'MANDYA'
            ] ,        
            [
                'states_id'=>29,
                'name'=>'MYSURU'
            ] ,        
            [
                'states_id'=>29,
                'name'=>'RAICHUR'
            ] ,        
            [
                'states_id'=>29,
                'name'=>'SHIVAMOGGA'
            ] ,        
            [
                'states_id'=>29,
                'name'=>'TUMAKURU'
            ] ,        
            [
                'states_id'=>29,
                'name'=>'UDUPI'
            ] ,        
            [
                'states_id'=>29,
                'name'=>'UTTARA KANN'
            ] ,        
            [
                'states_id'=>30,
                'name'=>'NORTH GOA'
            ] ,        
            [
                'states_id'=>30,
                'name'=>'SOUTH GOA'
            ] ,        
            [
                'states_id'=>31,
                'name'=>'LAKSHADWEEP'
            ] ,        
            [
                'states_id'=>32,
                'name'=>'ALAPPUZHA'
            ] ,        
            [
                'states_id'=>32,
                'name'=>'ERNAKULAM'
            ] ,        
            [
                'states_id'=>32,
                'name'=>'IDUKKI'
            ] ,        
            [
                'states_id'=>32,
                'name'=>'KANNUR'
            ] ,        
            [
                'states_id'=>32,
                'name'=>'KASARAGOD'
            ] ,        
            [
                'states_id'=>32,
                'name'=>'KOLLAM'
            ] ,        
            [
                'states_id'=>32,
                'name'=>'KOTTAYAM'
            ] ,        
            [
                'states_id'=>32,
                'name'=>'KOZHIKODE'
            ] ,        
            [
                'states_id'=>32,
                'name'=>'MALAPPURAM'
            ] ,        
            [
                'states_id'=>32,
                'name'=>'PALAKKAD'
            ] ,        
            [
                'states_id'=>32,
                'name'=>'PATHANAMTHI'
            ] ,        
            [
                'states_id'=>32,
                'name'=>'THIRUVANANT'
            ] ,        
            [
                'states_id'=>32,
                'name'=>'THRISSUR'
            ] ,        
            [
                'states_id'=>32,
                'name'=>'WAYANAD'
            ] ,        
            [
                'states_id'=>33,
                'name'=>'CHENNAI'
            ] ,        
            [
                'states_id'=>33,
                'name'=>'COIMBATORE'
            ] ,        
            [
                'states_id'=>33,
                'name'=>'CUDDALORE'
            ] ,        
            [
                'states_id'=>33,
                'name'=>'DHARMAPURI'
            ] ,        
            [
                'states_id'=>33,
                'name'=>'DINDIGUL'
            ] ,        
            [
                'states_id'=>33,
                'name'=>'ERODE'
            ] ,        
            [
                'states_id'=>33,
                'name'=>'KANCHIPURAM'
            ] ,        
            [
                'states_id'=>33,
                'name'=>'KANNIYAKUMA'
            ] ,        
            [
                'states_id'=>33,
                'name'=>'KARUR'
            ] ,        
            [
                'states_id'=>33,
                'name'=>'KRISHNAGIRI'
            ] ,        
            [
                'states_id'=>33,
                'name'=>'MADURAI'
            ] ,        
            [
                'states_id'=>33,
                'name'=>'NAGAPATTINA'
            ] ,        
            [
                'states_id'=>33,
                'name'=>'NAMAKKAL'
            ] ,        
            [
                'states_id'=>33,
                'name'=>'PERAMBALUR'
            ] ,        
            [
                'states_id'=>33,
                'name'=>'PUDUKKOTTAI'
            ] ,        
            [
                'states_id'=>33,
                'name'=>'RAMANATHAPU'
            ] ,        
            [
                'states_id'=>33,
                'name'=>'SALEM'
            ] ,        
            [
                'states_id'=>33,
                'name'=>'SIVAGANGA'
            ] ,        
            [
                'states_id'=>33,
                'name'=>'THANJAVUR'
            ] ,        
            [
                'states_id'=>33,
                'name'=>'THE NILGIRI'
            ] ,        
            [
                'states_id'=>33,
                'name'=>'THENI'
            ] ,        
            [
                'states_id'=>33,
                'name'=>'THIRUVALLUR'
            ] ,        
            [
                'states_id'=>33,
                'name'=>'THIRUVARUR'
            ] ,        
            [
                'states_id'=>33,
                'name'=>'TIRUCHIRAPP'
            ] ,        
            [
                'states_id'=>33,
                'name'=>'TIRUNELVELI'
            ] ,        
            [
                'states_id'=>33,
                'name'=>'TIRUVANNAMA'
            ] ,        
            [
                'states_id'=>33,
                'name'=>'TUTICORIN'
            ] ,        
            [
                'states_id'=>33,
                'name'=>'VELLORE'
            ] ,        
            [
                'states_id'=>33,
                'name'=>'VILLUPURAM'
            ] ,        
            [
                'states_id'=>33,
                'name'=>'VIRUDHUNAGA'
            ] ,        
            [
                'states_id'=>34,
                'name'=>'KARAIKAL'
            ] ,        
            [
                'states_id'=>34,
                'name'=>'MAHE'
            ] ,        
            [
                'states_id'=>34,
                'name'=>'PONDICHERRY'
            ] ,        
            [
                'states_id'=>34,
                'name'=>'YANAM'
            ] ,        
            [
                'states_id'=>35,
                'name'=>'SOUTH ANDAM'
            ] ,        
            [
                'states_id'=>35,
                'name'=>'NICOBARS'
            ] ,        
            [
                'states_id'=>6,
                'name'=>'NUH'
            ] ,        
            [
                'states_id'=>3,
                'name'=>'BARNALA'
            ] ,        
            [
                'states_id'=>20,
                'name'=>'KHUNTI'
            ] ,        
            [
                'states_id'=>20,
                'name'=>'RAMGARH'
            ] ,        
            [
                'states_id'=>3,
                'name'=>'S.A.S Nagar'
            ] ,        
            [
                'states_id'=>3,
                'name'=>'Tarn Taran'
            ] ,        
            [
                'states_id'=>33,
                'name'=>'Ariyalur'
            ] ,        
            [
                'states_id'=>10,
                'name'=>'ARWAL'
            ] ,        
            [
                'states_id'=>18,
                'name'=>'CHIRANG'
            ] ,        
            [
                'states_id'=>13,
                'name'=>'PEREN'
            ] ,        
            [
                'states_id'=>13,
                'name'=>'KIPHIRE'
            ] ,        
            [
                'states_id'=>13,
                'name'=>'LONGLENG'
            ] ,        
            [
                'states_id'=>18,
                'name'=>'BAKSA'
            ] ,        
            [
                'states_id'=>18,
                'name'=>'UDALGURI'
            ] ,        
            [
                'states_id'=>18,
                'name'=>'KAMRUP METR'
            ] ,        
            [
                'states_id'=>6,
                'name'=>'PALWAL'
            ] ,        
            [
                'states_id'=>1,
                'name'=>'KISHTWAR'
            ] ,        
            [
                'states_id'=>1,
                'name'=>'RAMBAN'
            ] ,        
            [
                'states_id'=>1,
                'name'=>'KULGAM'
            ] ,        
            [
                'states_id'=>1,
                'name'=>'BANDIPORA'
            ] ,        
            [
                'states_id'=>1,
                'name'=>'SAMBA'
            ] ,        
            [
                'states_id'=>1,
                'name'=>'SHOPIAN'
            ] ,        
            [
                'states_id'=>1,
                'name'=>'GANDERBAL'
            ] ,        
            [
                'states_id'=>1,
                'name'=>'REASI'
            ] ,        
            [
                'states_id'=>12,
                'name'=>'ANJAW'
            ] ,        
            [
                'states_id'=>8,
                'name'=>'PRATAPGARH'
            ] ,        
            [
                'states_id'=>29,
                'name'=>'CHIKKABALLA'
            ] ,        
            [
                'states_id'=>29,
                'name'=>'RAMANAGARA'
            ] ,        
            [
                'states_id'=>35,
                'name'=>'NORTH AND M'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'Kasganj'
            ] ,        
            [
                'states_id'=>33,
                'name'=>'TIRUPPUR'
            ] ,        
            [
                'states_id'=>29,
                'name'=>'YADGIR'
            ] ,        
            [
                'states_id'=>22,
                'name'=>'BIJAPUR'
            ] ,        
            [
                'states_id'=>22,
                'name'=>'NARAYANPUR'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'SINGRAULI'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'ALIRAJPUR'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'Amethi'
            ] ,        
            [
                'states_id'=>24,
                'name'=>'TAPI'
            ] ,        
            [
                'states_id'=>22,
                'name'=>'SUKMA'
            ] ,        
            [
                'states_id'=>22,
                'name'=>'KONDAGAON'
            ] ,        
            [
                'states_id'=>22,
                'name'=>'BALODA BAZA'
            ] ,        
            [
                'states_id'=>22,
                'name'=>'GARIYABAND'
            ] ,        
            [
                'states_id'=>22,
                'name'=>'BALOD'
            ] ,        
            [
                'states_id'=>22,
                'name'=>'MUNGELI'
            ] ,        
            [
                'states_id'=>22,
                'name'=>'SURAJPUR'
            ] ,        
            [
                'states_id'=>22,
                'name'=>'BALRAMPUR'
            ] ,        
            [
                'states_id'=>22,
                'name'=>'BEMETARA'
            ] ,        
            [
                'states_id'=>3,
                'name'=>'FAZILKA'
            ] ,        
            [
                'states_id'=>16,
                'name'=>'Khowai'
            ] ,        
            [
                'states_id'=>16,
                'name'=>'Sepahijala'
            ] ,        
            [
                'states_id'=>16,
                'name'=>'Gomati'
            ] ,        
            [
                'states_id'=>16,
                'name'=>'Unakoti'
            ] ,        
            [
                'states_id'=>17,
                'name'=>'NORTH GARO '
            ] ,        
            [
                'states_id'=>17,
                'name'=>'EAST JAINTI'
            ] ,        
            [
                'states_id'=>17,
                'name'=>'SOUTH WEST '
            ] ,        
            [
                'states_id'=>9,
                'name'=>'SAMBHAL'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'SHAMLI'
            ] ,        
            [
                'states_id'=>9,
                'name'=>'HAPUR'
            ] ,        
            [
                'states_id'=>3,
                'name'=>'PATHANKOT'
            ] ,        
            [
                'states_id'=>17,
                'name'=>'SOUTH WEST '
            ] ,        
            [
                'states_id'=>19,
                'name'=>'Alipurduar'
            ] ,        
            [
                'states_id'=>27,
                'name'=>'PALGHAR'
            ] ,        
            [
                'states_id'=>12,
                'name'=>'LONGDING'
            ] ,        
            [
                'states_id'=>23,
                'name'=>'AGAR MALWA'
            ] ,        
            [
                'states_id'=>24,
                'name'=>'CHHOTAUDEPU'
            ] ,        
            [
                'states_id'=>24,
                'name'=>'Mahisagar'
            ] ,        
            [
                'states_id'=>7,
                'name'=>'South East'
            ] ,        
            [
                'states_id'=>7,
                'name'=>'SHAHDARA'
            ] ,        
            [
                'states_id'=>24,
                'name'=>'ARVALLI'
            ] ,        
            [
                'states_id'=>24,
                'name'=>'MORBI'
            ] ,        
            [
                'states_id'=>24,
                'name'=>'DEVBHUMI DW'
            ] ,        
            [
                'states_id'=>24,
                'name'=>'GIR SOMNATH'
            ] ,        
            [
                'states_id'=>24,
                'name'=>'BOTAD'
            ] ,        
            [
                'states_id'=>12,
                'name'=>'KRA  DAADI'
            ] ,        
            [
                'states_id'=>12,
                'name'=>'NAMSAI'
            ] ,        
            [
                'states_id'=>12,
                'name'=>'SIANG'
            ] ,        
            [
                'states_id'=>36,
                'name'=>'Nirmal'
            ] ,        
            [
                'states_id'=>36,
                'name'=>'Jagitial'
            ] ,        
            [
                'states_id'=>36,
                'name'=>'PEDDAPALLI'
            ] ,        
            [
                'states_id'=>36,
                'name'=>'RAJANNA SIR'
            ] ,        
            [
                'states_id'=>36,
                'name'=>'MANCHERIAL'
            ] ,        
            [
                'states_id'=>36,
                'name'=>'KAMAREDDY'
            ] ,        
            [
                'states_id'=>36,
                'name'=>'WARANGAL UR'
            ] ,        
            [
                'states_id'=>36,
                'name'=>'JAYASHANKAR'
            ] ,        
            [
                'states_id'=>36,
                'name'=>'MAHABUBABAD'
            ] ,        
            [
                'states_id'=>36,
                'name'=>'JANGOAN'
            ] ,        
            [
                'states_id'=>36,
                'name'=>'BHADRADRI K'
            ] ,        
            [
                'states_id'=>36,
                'name'=>'SANGAREDDY'
            ] ,        
            [
                'states_id'=>36,
                'name'=>'SIDDIPET'
            ] ,        
            [
                'states_id'=>36,
                'name'=>'WANAPARTHY'
            ] ,        
            [
                'states_id'=>36,
                'name'=>'NAGARKURNOO'
            ] ,        
            [
                'states_id'=>36,
                'name'=>'JOGULAMBA G'
            ] ,        
            [
                'states_id'=>36,
                'name'=>'SURYAPET'
            ] ,        
            [
                'states_id'=>36,
                'name'=>'YADADRI BHU'
            ] ,        
            [
                'states_id'=>36,
                'name'=>'VIKARABAD'
            ] ,        
            [
                'states_id'=>36,
                'name'=>'KUMURAM BHE'
            ] ,        
            [
                'states_id'=>36,
                'name'=>'MEDCHAL MAL'
            ] ,        
            [
                'states_id'=>6,
                'name'=>'CHARKI DADR'
            ] ,        
            [
                'states_id'=>19,
                'name'=>'KALIMPONG'
            ] ,        
            [
                'states_id'=>19,
                'name'=>'Jhargram'
            ] ,        
            [
                'states_id'=>19,
                'name'=>'PASCHIM BAR'
            ] ,        
            [
                'states_id'=>18,
                'name'=>'Biswanath'
            ] ,        
            [
                'states_id'=>18,
                'name'=>'MAJULI'
            ] ,        
            [
                'states_id'=>18,
                'name'=>'SOUTH SALMA'
            ] ,        
            [
                'states_id'=>18,
                'name'=>'CHARAIDEO'
            ] ,        
            [
                'states_id'=>18,
                'name'=>'HOJAI'
            ] ,        
            [
                'states_id'=>18,
                'name'=>'WEST KARBI '
            ] ,        
            [
                'states_id'=>14,
                'name'=>'KAKCHING'
            ] ,        
            [
                'states_id'=>14,
                'name'=>'KANGPOKPI'
            ] ,        
            [
                'states_id'=>14,
                'name'=>'JIRIBAM'
            ] ,        
            [
                'states_id'=>14,
                'name'=>'NONEY'
            ],
            [
                'states_id'=>14,
                'name'=>'PHERZAWL'
            ],           
            [
                'states_id'=>14,
                'name'=>'TENGNOUPAL'
            ],           
            [
                'states_id'=>14,
                'name'=>'KAMJONG'
            ],           
            [
                'states_id'=>12,
                'name'=>'KAMLE'
            ],           
            [
                'states_id'=>12,
                'name'=>'LOWER SIANG'
            ],          
            [
                'states_id'=>36,
                'name'=>'Mulugu'
            ],           
            [
                'states_id'=>36,
                'name'=>'Narayanpet'
            ],           
            [
                'states_id'=>23,
                'name'=>'Niwari'
            ],           
            [
                'states_id'=>12,
                'name'=>'PAKKE KESSA'
            ],           
            [
                'states_id'=>12,
                'name'=>'LEPARADA'
            ],            
            [
                'states_id'=>12,
                'name'=>'SHI YOMI'
            ]
        ]);

    }
}
