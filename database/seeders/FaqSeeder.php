<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('faqs')->delete();
        \DB::table('faqs')->insert([
            [
                'title' => 'Who will be my trainer?',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad ducimus nisi modi recusandae quas porro! Eligendi ducimus saepe, et ipsam rerum repellendus cum harum quaerat dignissimos expedita molestiae incidunt magni.',
                'is_active' => '1',
                'created_at' => '2021-03-26 09:56:35',
                'updated_at' => '2021-03-26 09:56:35',
            ],
            [
                'title' => 'How are your trainers selected?',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad ducimus nisi modi recusandae quas porro! Eligendi ducimus saepe, et ipsam rerum repellendus cum harum quaerat dignissimos expedita molestiae incidunt magni.',
                'is_active' => '1',
                'created_at' => '2021-03-26 09:56:35',
                'updated_at' => '2021-03-26 09:56:35',
            ],
            [
                'title' => 'Can I select my english trainer myself?',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad ducimus nisi modi recusandae quas porro! Eligendi ducimus saepe, et ipsam rerum repellendus cum harum quaerat dignissimos expedita molestiae incidunt magni.',
                'is_active' => '1',
                'created_at' => '2021-03-26 09:56:35',
                'updated_at' => '2021-03-26 09:56:35',
            ],
            [
                'title' => 'Can I change my trainer?',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad ducimus nisi modi recusandae quas porro! Eligendi ducimus saepe, et ipsam rerum repellendus cum harum quaerat dignissimos expedita molestiae incidunt magni.',
                'is_active' => '1',
                'created_at' => '2021-03-26 09:56:35',
                'updated_at' => '2021-03-26 09:56:35',
            ],
            [
                'title' => 'Will I get this same trainer in all my classess?',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad ducimus nisi modi recusandae quas porro! Eligendi ducimus saepe, et ipsam rerum repellendus cum harum quaerat dignissimos expedita molestiae incidunt magni.',
                'is_active' => '1',
                'created_at' => '2021-03-26 09:56:35',
                'updated_at' => '2021-03-26 09:56:35',
            ],
            [
                'title' => 'Can i get the same trainer that I had the trial session with?',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad ducimus nisi modi recusandae quas porro! Eligendi ducimus saepe, et ipsam rerum repellendus cum harum quaerat dignissimos expedita molestiae incidunt magni.',
                'is_active' => '1',
                'created_at' => '2021-03-26 09:56:35',
                'updated_at' => '2021-03-26 09:56:35',
            ],
            [
                'title' => 'What areas of spoken english can I expect to improve?',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad ducimus nisi modi recusandae quas porro! Eligendi ducimus saepe, et ipsam rerum repellendus cum harum quaerat dignissimos expedita molestiae incidunt magni.',
                'is_active' => '1',
                'created_at' => '2021-03-26 09:56:35',
                'updated_at' => '2021-03-26 09:56:35',
            ],
            [
                'title' => 'In how much time can I start to speak English fluently?',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad ducimus nisi modi recusandae quas porro! Eligendi ducimus saepe, et ipsam rerum repellendus cum harum quaerat dignissimos expedita molestiae incidunt magni.',
                'is_active' => '1',
                'created_at' => '2021-03-26 09:56:35',
                'updated_at' => '2021-03-26 09:56:35',
            ],
            
            [
                'title' => 'Do you teach grammar?',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad ducimus nisi modi recusandae quas porro! Eligendi ducimus saepe, et ipsam rerum repellendus cum harum quaerat dignissimos expedita molestiae incidunt magni.',
                'is_active' => '1',
                'created_at' => '2021-03-26 09:56:35',
                'updated_at' => '2021-03-26 09:56:35',
            ],
            
            [
                'title' => 'Can you help me prepare for the TOEFL/IELTS Speaking section?',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad ducimus nisi modi recusandae quas porro! Eligendi ducimus saepe, et ipsam rerum repellendus cum harum quaerat dignissimos expedita molestiae incidunt magni.',
                'is_active' => '1',
                'created_at' => '2021-03-26 09:56:35',
                'updated_at' => '2021-03-26 09:56:35',
            ],
            
            [
                'title' => 'How do I join English Speaking Course?',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad ducimus nisi modi recusandae quas porro! Eligendi ducimus saepe, et ipsam rerum repellendus cum harum quaerat dignissimos expedita molestiae incidunt magni.',
                'is_active' => '1',
                'created_at' => '2021-03-26 09:56:35',
                'updated_at' => '2021-03-26 09:56:35',
            ],
            
            [
                'title' => 'Do you offer free trial sessions for Spoken English?',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad ducimus nisi modi recusandae quas porro! Eligendi ducimus saepe, et ipsam rerum repellendus cum harum quaerat dignissimos expedita molestiae incidunt magni.',
                'is_active' => '1',
                'created_at' => '2021-03-26 09:56:35',
                'updated_at' => '2021-03-26 09:56:35',
            ],
            
            [
                'title' => 'How much English do I need to know so as to be eligible?',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad ducimus nisi modi recusandae quas porro! Eligendi ducimus saepe, et ipsam rerum repellendus cum harum quaerat dignissimos expedita molestiae incidunt magni.',
                'is_active' => '1',
                'created_at' => '2021-03-26 09:56:35',
                'updated_at' => '2021-03-26 09:56:35',
            ],
            
            [
                'title' => "Do you offer kids/children's English Speaking classes?",
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad ducimus nisi modi recusandae quas porro! Eligendi ducimus saepe, et ipsam rerum repellendus cum harum quaerat dignissimos expedita molestiae incidunt magni.',
                'is_active' => '1',
                'created_at' => '2021-03-26 09:56:35',
                'updated_at' => '2021-03-26 09:56:35',
            ],
            
            [
                'title' => "How to schedule a session?",
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad ducimus nisi modi recusandae quas porro! Eligendi ducimus saepe, et ipsam rerum repellendus cum harum quaerat dignissimos expedita molestiae incidunt magni.',
                'is_active' => '1',
                'created_at' => '2021-03-26 09:56:35',
                'updated_at' => '2021-03-26 09:56:35',
            ],
            [
                'title' => "How will sessions take place?",
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad ducimus nisi modi recusandae quas porro! Eligendi ducimus saepe, et ipsam rerum repellendus cum harum quaerat dignissimos expedita molestiae incidunt magni.',
                'is_active' => '1',
                'created_at' => '2021-03-26 09:56:35',
                'updated_at' => '2021-03-26 09:56:35',
            ],
            [
                'title' => "How can I cancel a session?",
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad ducimus nisi modi recusandae quas porro! Eligendi ducimus saepe, et ipsam rerum repellendus cum harum quaerat dignissimos expedita molestiae incidunt magni.',
                'is_active' => '1',
                'created_at' => '2021-03-26 09:56:35',
                'updated_at' => '2021-03-26 09:56:35',
            ],
            [
                'title' => "What's the cost?",
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad ducimus nisi modi recusandae quas porro! Eligendi ducimus saepe, et ipsam rerum repellendus cum harum quaerat dignissimos expedita molestiae incidunt magni.',
                'is_active' => '1',
                'created_at' => '2021-03-26 09:56:35',
                'updated_at' => '2021-03-26 09:56:35',
            ],
            [
                'title' => "Can I share the classes I purchased with my family members/friends?",
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad ducimus nisi modi recusandae quas porro! Eligendi ducimus saepe, et ipsam rerum repellendus cum harum quaerat dignissimos expedita molestiae incidunt magni.',
                'is_active' => '1',
                'created_at' => '2021-03-26 09:56:35',
                'updated_at' => '2021-03-26 09:56:35',
            ],
            [
                'title' => "Terms and conditions",
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad ducimus nisi modi recusandae quas porro! Eligendi ducimus saepe, et ipsam rerum repellendus cum harum quaerat dignissimos expedita molestiae incidunt magni.',
                'is_active' => '1',
                'created_at' => '2021-03-26 09:56:35',
                'updated_at' => '2021-03-26 09:56:35',
            ],
            [
                'title' => "Privacy Policies",
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad ducimus nisi modi recusandae quas porro! Eligendi ducimus saepe, et ipsam rerum repellendus cum harum quaerat dignissimos expedita molestiae incidunt magni.',
                'is_active' => '1',
                'created_at' => '2021-03-26 09:56:35',
                'updated_at' => '2021-03-26 09:56:35',
            ],
            
            [
                'title' => "Refunds Policy",
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad ducimus nisi modi recusandae quas porro! Eligendi ducimus saepe, et ipsam rerum repellendus cum harum quaerat dignissimos expedita molestiae incidunt magni.',
                'is_active' => '1',
                'created_at' => '2021-03-26 09:56:35',
                'updated_at' => '2021-03-26 09:56:35',
            ],
            
            [
                'title' => "Cancellations Policy",
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad ducimus nisi modi recusandae quas porro! Eligendi ducimus saepe, et ipsam rerum repellendus cum harum quaerat dignissimos expedita molestiae incidunt magni.',
                'is_active' => '1',
                'created_at' => '2021-03-26 09:56:35',
                'updated_at' => '2021-03-26 09:56:35',
            ],
            
        
        ]);
        
    }
}
