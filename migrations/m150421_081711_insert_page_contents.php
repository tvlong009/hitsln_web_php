<?php

use yii\db\Migration;

class m150421_081711_insert_page_contents extends Migration
{

    public function up()
    {
$html['About us'] = <<<'HTML'
<p style="text-align: justify;"><strong>Target Music</strong> is based in Huizen. It began its operations in 2004 and was a supplier of the Planet Music platform, one of the first audio streaming platforms in the Netherlands. This is some random text added to test the justify alignment of the whole paragraph.</p><p style="text-align: justify;"><strong>TargetMedia B.V., </strong>founded in 1995, delivers since 2001 through white-label digital music product and service solutions, such as Ringtones, to companies such as MSN, Samsung, etc. In 2007 a completely DRM-free music download platform was developed and in 2008 introduced in the Dutch market through the DownloadMusic.nl web. In 2009 TargetMedia bought the Aim4Music business and integrated it together with the TargetMedia download platform into a new independent entity: Target Media Music Partners Holding B.V., which includes the operating company TargetMusic B.V.</p><p style="text-align: justify;">At the end of 2009, a substantial minority share of this new holding company was sold to Polydor B.V. (Universal Music) and Media and More Factory B.V. (including DJ Erik de Zwart), providing over 100 years of experience, knowledge and expertise in the music industry to the company.</p><p style="text-align: justify;">The objective of the company is to provide a complete infrastructure, from development through delivery, for the marketing of digital music content including MP3 Downloads and Streaming Audio. TargetMusic is a White Label Technology supplier third party companies offering the possibility to market digital music content under its own brand name. The company has an international orientation, but also maintains a fundamental objective to continue support and providing Dutch language music products. TargetMusic not only provides all the technology, but also all necessary licensing and fees, such as to the record companies (including Universal Music, Sony, EMI, Warner Music) and agencies (including Buma Stemra).</p><p style="text-align: justify;">Our platforms are currently used for direct consumer sales of the complete digital music catalog not only by companies in the music industry (e.g., Radio Station Radio 538), but also for marketing campaigns using only portions of the available content (e.g., Shell Music Weeks). Additionally, in cooperation with our sister company TargetMedia B.V., we provide complete solutions where various payment solutions in combination with the music content are required. For example, various TV programs such as Popstars, Idols and The Voice of Holland used our solutions of digital music content.</p><p style="text-align: justify;">TargetMusic thereby offers a genuine ''one stop shop'' which supports marketing efforts to realize digital music solutions under their own brand, as well as establishing contacts and building cooperation with the various music labels for showcases, performances, etc.</p>
HTML;
$html['Terms & Conditions'] = <<<'HTML'
<h4>Terms &amp; Conditions</h4><p>Terms &amp; Conditions apply to the use of the TargetMusic website and services. The use of our services is based upon your acceptance and compliance with these rights and obligations.<br></p><h4>Definitions</h4><p>1. TargetMusic is a licensed and registered trade name of TargetMusic B.V. TargetMusic B.V. is a privately held limited liability company with its Headquarters at Huizermaatweg 550A, 1276LM Huizen (The Netherlands). It is registered by the Chamber of Commerce with the Number 32156308 and assigned the VAT Number NL8210.50.540.B.01.</p><p>2. Affiliate: Each entity, which has accepted these Terms &amp; Conditions and is accepted by TargetMusic as an Affiliate is authorized to offer mobile services via TargetMusic.</p><p>3. Affiliate site: The affiliate participates with this internet webpage or -pages to the partner program of TargetMusic.</p><h4>Registration and Acceptance</h4><p>1. To register as an Affiliate, this maintains that these Terms &amp; Conditions are accepted and respected.</p><p>2. For Acceptance as an Affiliate it is required that TargetMusic receives the complete registration form within 7 working days after receipt of the acceptance of these Terms &amp; Conditions for confirmation and TargetMusic notifies that they do not accept this registration.</p><p>3.If TargetMusic does not inform within seven (7) days, after receiving the complete filled out forms with the acceptance of the Terms &amp; Conditions then acceptance of Affiliate will become final.</p><h4>Limitations and Restrictions</h4><p>1. The affiliate will use the delivered content only for the partner program and will not change the content.</p><p>2. Affiliates are not permitted to use this partner program for transactions and/or conduct which conflicts with legal regulations, the netiquette, guidelines of the Advertising Code Committee, the Code of Conduct (Netherlands), the Code of Ethics (Belgium), the agreement or these general Terms and Conditions. Hereunder fall, included but not limited to, the following transactions and behaviours:</p><p>3. spamming: to send unasked large quantities of SMS, containing the same content and/or posting unasked quantities of messages containing the same content on the internet; Infringement of copyrights and/or other property rights which are inconsistent with the intellectual property rights of third parties; Misleading of third parties.</p><h4>Commission</h4><p>1. The Affiliate is entitled to a commission, if TargetMusic registers a sale via an Affiliate site. This commission is VAT excluded for Company registered Affiliates. If this is the case, which is in use accordance with the Dutch law, VAT will be calculated over the commission.</p><p>2. The registration of sales, as published on the website of TargetMusic, is stringent to the Affiliate.</p><p>3. The Affiliate permits TargetMusic to generate credit notes for payment of the commission. In case the Affiliate wishes to take care of the invoicing itself, this should be discussed first with TargetMusic.</p><p>4. The payment of the commission will be executed ten (10) weeks after the end of each month at the given Affiliates bank account number. Commission amounts below € 25 (say: twenty five Euros) will not be paid. In case the commission over one month is less then € 25 (say: twenty five Euros), no payment will be done in the month concerned and this amount will be saved. The payment will execute in case the total amount of € 25 (say: twenty five Euros) or more is achieved;</p><p>5. In case of payments to Affiliates (registered outside the Netherlands, the minimum earnings must be over € 50 (say: fifty Euros). In case the commission over one month is less than € 50 (say: fifty Euros), no payment will be done and the commission will be saved. The payment will be executed in the month whereas the total amount of € 50 (say: fifty Euros) or more is achieved. Possible bank costs will be deducted on the amount payable in case these costs are above € 10 (say: ten Euros) per transaction.</p><p>6. The total amount of the commission will be paid every month in retrospect in Euros by TargetMusic. Undiminished by mentioning the relation to the minimal height of the credit balance, the payment will take place within seven (7) working days after the end of the concerning month.</p><h4>Termination</h4><p>1. TargetMusic has the right to terminate this Affiliate agreement at all times, considering a termination period of two (2) weeks. Without prejudice to any other TargetMusic rights, TargetMusic is authorized to end the Affiliate agreement with immediate effect is case of: The Affiliate infringes with the Terms &amp; Conditions;</p><p>2. The Affiliate has the right to end this agreement at all times, without taking into account the period of termination, unless it is an exclusive agreement next to these Terms &amp; Conditions. Unsubscribing must be done in writing, by using the completed termination form, which needs to be signed off and sent to TargetMusic B.V., Huizermaatweg 550A, 1276LM, Huizen, the Netherlands.</p><p>3. Due to termination, possible commission amounts will be paid by TargetMusic, if the minimum payment amount of € 25, - for Dutch Affiliates and € 50, - for foreign Affiliates is achieved. Outstanding commission amounts will be reported and paid ten (10) weeks after the end of each month and after termination via a credit note. No claims can be done by Affiliate for amounts lower than the minimum amount of payment. These amounts will revert to TargetMusic.</p><h4>Privacy</h4><p>All reported information will be treated with respect and will remain strictly confidential. Neither party will disclose any information to third parties before consulting the other party.</p><h4>Liability</h4><p>1. TargetMusic does not accept any damages or losses of the Affiliate or third party for the services offered;</p><p>2. TargetMusic is responsible for 24/7 accessibility of the partner program, except for periodical maintenance, technical disturbances and Force Majeure. TargetMusic is not liable or responsible for any possible loss of turnover or other possible costs which might result from this;</p><p>3. Affiliate warrants that it will meet the obligations required by fiscal legislation and will safeguard TM from of all related claims in this matter.</p><p>4. The Affiliate is solely accuracy for the correctness content of the account data.</p><p>5. TargetMusic is not liable or responsible for delays and/or errors in payments which were caused to wrong or invalid given information.</p><h4>Other</h4><p>1. The Affiliate is not entitled to accept obligations, is not allowed to express promises or act on behalf of TargetMusic.</p><p>2. The Affiliate is not entitled to transfer the Affiliate agreement to a third party.</p><p>3. TargetMusic is entitled to change these Terms &amp; Conditions at all time. The Affiliate will be notified digitally of these changes. In case of changed Terms &amp; Conditions, which might be unacceptable for the Affiliate, the Affiliate is entitled to end the Affiliate agreement. The Affiliate respects and accepts this changed Affiliate agreement, in case the Affiliate does not end the agreement.</p><p>4. In case any definition of this agreement infringes with appropriate law, this definition will be changed in accordance with the appropriate law by taking into account the purpose of the definition concerned.</p><p>5. The Terms &amp; Conditions are governed by and construed in accordance with the laws of the Netherlands and each party consents to the exclusive jurisdiction of the Dutch courts for adjudication of any disputes arising out of this agreement.</p>
HTML;
$html['Disclaimer'] = <<<'HTML'
<h4>Copyright</h4><p>TargetMusic is a licensed trade name of TargetMusic B.V., The Netherlands.</p><p>© Copyright TargetMusic B.V. All rights reserved worldwide.</p><h4>Disclaimer</h4><p>The publisher, TargetMusic B.V., cannot be held responsible for any damage, material or immaterial, direct or indirect, caused by the contents of the information provided by a third party on its websites or in SMS/MMS and e-mail messages. This includes but is not limited to copyright infringements or any other intellectual property issues.</p><p>The music content offered by TargetMusic B.V. is subject to copyright protection. Copyright and other required fees are paid for musical works as applicable.</p>
HTML;
$html['Digital Music Downloads'] = <<<'HTML'
<p>Digital Music offers your users flexibility and portability. Users can play their music on any device of their choice and whenever they wish.<br></p><p>Our music download platform provides users the ability to download invidual tracks or complete albums, with full preview capabilities for each track. Every track does not use DRM <span class="hight_line_red">(Digital Rights Management) </span>encryption, allowing it to be played on PCs, mp3 Players, Smartphones, Tablets, etc.</p><p>The download not only includes the track but any related artwork and compressed into a zip file for quicker download and installation on any operating system. All downloads are completely legal as the sale price includes all required licensing payments (label company and regulatory agencies).</p><p>Our platform allows you to offer a complete music library to your customers. It is also possible to use subsets to target the available music to specific user groups, or even to promote isolated tracks for special events. Our automated systems provide real time execution of all transactions eliminating the back office paperwork.</p><p>With our API the functionality is easy to integrate into your website. For dedicated custom sites, we also offer a complete package incorporating your design objectives into a finished product. A sample of our download platform can be seen <a class="hight_line_red" href="http://localhost/targetmusic_cms/frontend/web/index.php?r=service%2Fservice-download">here</a>.</p>        
HTML;
$html['Music Streaming'] = <<<'HTML'
<p>Whether the objective is to provide a complete streaming platform as a dedicated service, or as an add-on to your existing web platform to increase customer retention, our music streaming platform is the ideal solution.</p><p>It provides the ability to allow your customer to play streams without having to install any special software on the PC or install special applications on smartphones. This is possible through the use of HTML5 in modern browsers connecting to our API. Your time to market and implementation times are thereby drastically reduced. The API also supports integration with smartphone applications.</p><p>Through the flexibility built into our API, we can also maintain individual user accounts allowing for detailed tracking of music selection and playback patterns. As an alternative it can permit your website to provide the user authtification to our streaming system. Detailed usage information is still available through the use of session IDs. <br>It also assists in the attraction of new users by offering previews on a per track basis. To help build customer loyalty, social networking functions are also built in. These allow the user to create groups, share playlists, etc.</p><p>For promotional applications we also offer the ability to use pre-assigned tokens. The tokens can be distributed as part of your advertising campaign and allow the user to play the predefined track without any registration requirements. Ideal for seasonal promotions, special events or targeted marketing campaigns.</p><p>Our Music Streaming platform not only supports a range of stream types but also at different playback speeds. This makes it ideal for both home, office and mobile applications. Reliability is a critical factor in the design and more over the technology can be found under <a href="http://localhost/targetmusic_cms/frontend/web/index.php?r=service%2Fservice-music-streaming#" class="hight_line_red">Our Technology</a> .</p><p>An example of our API and HTML5 in use is <a class="hight_line_red" href="http://localhost/targetmusic_cms/frontend/web/index.php?r=service%2Fservice-music-streaming#">here</a> .</p>        
HTML;

        $pages_array = [
                    ['About us', 'published', NULL, 0, NULL, '2015-04-20 15:26:31', '2015-04-21 13:59:42', NULL],
                    ['Terms & Conditions', 'published', NULL, 0, NULL, '2015-04-20 15:42:09', '2015-04-21 13:35:51', NULL],
                    ['Disclaimer', 'published', NULL, 0, NULL, '2015-04-20 15:54:03', '2015-04-20 15:54:03', NULL],
                    ['Digital Music Downloads', 'published', NULL, 0, NULL, '2015-04-20 16:08:08', '2015-04-20 16:42:24', NULL],
                    ['Music Streaming', 'published', NULL, 0, NULL, '2015-04-20 16:13:47', '2015-04-20 16:13:47', NULL]
                    ];
        $array_keys = ['key', 'status', 'publish_date', 'sort_order', 'parent_id', 'created', 'modified', 'user_id'];
        
        $page_content_array = [
            "About us" => ['Our beginnings...', $html["About us"], 1, '', '2015-04-20 15:26:31', '2015-04-21 13:59:42'],
            "Terms & Conditions" => ['Terms & Conditions', $html["Terms & Conditions"], 1, '', '2015-04-20 15:42:09', '2015-04-21 13:35:51'],
            "Disclaimer" => ['Disclaimer', $html["Disclaimer"], 1, '', '2015-04-20 15:54:04', '2015-04-20 15:54:04'],
            "Digital Music Downloads" => ['Digital Music Downloads', $html["Digital Music Downloads"], 1, '', '2015-04-20 16:08:08', '2015-04-20 16:42:24'],
            "Music Streaming" => ['Music Streaming', $html["Music Streaming"], 1, '', '2015-04-20 16:13:48', '2015-04-20 16:13:48'],
        ];
        $array_pc_keys = ['page_id', 'title', 'content', 'language', 'header_img', 'created', 'modified'];
        //insert pages to database
        foreach($pages_array as $page){
            $page = array_combine($array_keys, $page);
            $this->insert('pages', $page);
            $pageID = $this->db->lastInsertID;
            array_unshift($page_content_array[$page["key"]], $pageID);
        }
        //insert page_content to database
        foreach($page_content_array as $page_content){
            $page_content = array_combine($array_pc_keys, $page_content);
            $this->insert('page_content', $page_content);
        }
    }
    public function down()
    {
        echo "m150421_081711_insert_page_contents cannot be reverted.\n";

        return false;
    }
    
    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }
    public function safeDown()
    {
    }
    */
}
