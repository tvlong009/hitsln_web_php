<?php

use yii\db\Schema;
use yii\db\Migration;

class m150526_063709_page_content_update extends Migration
{
    public function safeUp()
    {
        $languages = app\models\Languages::find()->all();
        if(!empty($languages)){
            $continue = true;
            foreach($languages as $language){
                if($language->is_default){
                    $languageID = $language->id;
                    $continue = false;
                    break;
                }
            }
            
            reset($languages);
            
            if($continue){
                foreach($languages as $language){
                    if($language->is_active){
                        $languageID = $language->id;
                        $continue = false;
                        break;
                    }
                }
            }
            
            if($continue){
                $language = $languages[0];
                $languageID = $language;
            }

        } else {
            $this->insert('Languages',
                    [
                        'name' => 'English',
                        'description' => 'English',
                        'code' => 'en',
                        'is_active' => 1,
                        'is_default' => 1,
                    ]
            );
            $languageID = $this->db->lastInsertID;
        }
        $this->dropForeignKey('fk_pages_page_content', 'page_content');
        $this->truncateTable('page_content');
        $this->truncateTable('pages');
        $this->addForeignKey('fk_pages_page_content', 'page_content', 'page_id', 'pages', 'id');
        
$html['Index'] = '';

$html['About us'] = <<<'HTML'
<div class="site_content">

		<!-- Breadcrumb -->
		<div class="breadcrumb_site breadcrumb_about">
			<div class="container">
				<div class="row">
					<h2>About us</h2>
				</div>
			</div>
		</div>
		<!-- End Breadcrumb -->


		<!-- Box content page -->
		<div class="main_box_content">
			<div class="container">
				<div class="row bg_about">								
					<div class="col-sm-7 col-md-7 ">
						<h3 class="title_main_box_content">Our beginnings...</h3>

						<div class="justify">
							<p><span class="hight_line">Target Music</span> is based in Huizen. It began its operations in 2004 and was a supplier of the Planet Music platform, one of the first audio streaming platforms in the Netherlands.</p>

							<p><span class="hight_line">TargetMedia B.V., </span>founded in 1995, delivers since 2001 through white-label digital music product and service solutions, such as Ringtones, to companies such as MSN, Samsung, etc. In 2007 a completely DRM-free music download platform was developed and in 2008 introduced in the Dutch market through the DownloadMusic.nl web. In 2009 TargetMedia bought the Aim4Music business and integrated it together with the TargetMedia download platform into a new independent entity: Target Media Music Partners Holding B.V., which includes the operating company TargetMusic B.V.</p>

							<p>At the end of 2009, a substantial minority share of this new holding company was sold to Polydor B.V. (Universal Music) and Media and More Factory B.V. (including DJ Erik de Zwart), providing over 100 years of experience, knowledge and expertise in the music industry to the company.</p>

							<p>The objective of the company is to provide a complete infrastructure, from development through delivery, for the marketing of digital music content including MP3 Downloads and Streaming Audio. TargetMusic is a White Label Technology supplier third party companies offering the possibility to market digital music content under its own brand name. The company has an international orientation, but also maintains a fundamental objective to continue support and providing Dutch language music products. TargetMusic not only provides all the technology, but also all necessary licensing and fees, such as to the record companies (including Universal Music, Sony, EMI, Warner Music) and agencies (including Buma Stemra).</p>

							<p>Our platforms are currently used for direct consumer sales of the complete digital music catalog not only by companies in the music industry (e.g., Radio Station Radio 538), but also for marketing campaigns using only portions of the available content (e.g., Shell Music Weeks). Additionally, in cooperation with our sister company TargetMedia B.V., we provide complete solutions where various payment solutions in combination with the music content are required. For example, various TV programs such as Popstars, Idols and The Voice of Holland used our solutions of digital music content.</p>

							<p>TargetMusic thereby offers a genuine ‘one stop shop’ which supports marketing efforts to realize digital music solutions under their own brand, as well as establishing contacts and building cooperation with the various music labels for showcases, performances, etc.</p>
							</div>
							<button class="btn btn-yellow" > Information Request</button>

							<div class="height_200"></div>
					</div>
					<div class="hidden-xs scol-sm-5 col-md-5">

						<!-- Slide -->

							<div class="diy-slideshow">
								<figure class="show">
									<img src="img/slide/about_1.jpg" width="100%" />							
								</figure>								
							    <figure>
							   		 <img src="img/slide/about_2.jpg"  width="100%"  />
								</figure>
								<figure>
									<img src="img/slide/about_3.jpg" width="100%" />
								</figure>
							 	 <figure>
									<img src="img/slide/about_4.jpg" width="100%" />
								</figure>
							
							  <span class="prev"><i class="fa fa-angle-left"></i></span>
							  <span class="next"><i class="fa fa-angle-right"></i></span>
							</div>  

						<!-- End slide -->

						

					</div>
				</div>
			</div>			
		</div>
		<!-- END:Box content page -->
	
</div>
HTML;

$html['Music Labels'] = <<<'HTML'
<div class="site_content">

		<!-- Breadcrumb -->
		<div class="breadcrumb_site breadcrumb_terms">
			<div class="container">
				<div class="row">
					<h2>MUSIC LABELS</h2>
				</div>
			</div>
		</div>
		<!-- End Breadcrumb -->


		<!-- Box content page -->
		<div class="main_box_content">
			<div class="container">
				<div class="row">	

					<div class="col-md-12">
						<h3 class="title_main_box_content">Our Partnership with the Music Labels Insures Quality Content</h3>	
					</div>

					<div class="col-sm-12  col-md-12 box_music_label">
						<div class="row">
							<div class="col-md-5">
								<img src="img/musiclabel/1.jpg">								
							</div>
							<div class="col-md-7 bottom_yellow">
								<div class="text_info_music_label scroll_bar">
									<h4>Universal Music Netherlands</h4>
									<p>is the world’s largest music content company with market leading positions in recorded music, music publishing, and merchandising.</p>
									<p>The recorded music business discovers and develops recording artists and then markets and promotes their music across a wide array of formats and platforms. UMG’s music publishing company, Universal Music Publishing Group, discovers and develops songwriters, and owns and administers copyrights to musical compositions for use in recordings, public performances, and related uses, such as films and advertisements. Bravado, UMG’s merchandising company, sells artist- and music-branded products via multiple sales point such as fashion retail</p>
									<p>The recorded music business discovers and develops recording artists and then markets and promotes their music across a wide array of formats and platforms. UMG’s music publishing company, Universal Music Publishing Group, discovers and develops songwriters, and owns and administers copyrights to musical compositions for use in recordings, public performances, and related uses, such as films and advertisements. Bravado, UMG’s merchandising company, sells artist- and music-branded products via multiple sales point such as fashion retail</p>

									<p>The recorded music business discovers and develops recording artists and then markets and promotes their music across a wide array of formats and platforms. UMG’s music publishing company, Universal Music Publishing Group, discovers and develops songwriters, and owns and administers copyrights to musical compositions for use in recordings, public performances, and related uses, such as films and advertisements. Bravado, UMG’s merchandising company, sells artist- and music-branded products via multiple sales point such as fashion retail</p>
								</div>

							</div>
						</div>
					</div>

					<div class="col-sm-4 col-md-12 box_music_label">
						<div class="row">
							<div class="col-md-5">
								<img src="img/musiclabel/2.jpg">								
							</div>
							<div class="col-md-7 bottom_red">
								<div class="text_info_music_label">
									<h4>Universal Music Netherlands</h4>
									<p>is the world’s largest music content company with market leading positions in recorded music, music publishing, and merchandising.</p>
									<p>The recorded music business discovers and develops recording artists and then markets and promotes their music across a wide array of formats and platforms. </p>
								</div>

							</div>							
						</div>
					</div>


					<div class="col-sm-4 col-md-12 box_music_label">
						<div class="row">
							<div class="col-md-5">
								<img src="img/musiclabel/3.jpg">								
							</div>
							<div class="col-md-7 bottom_orange">
								<div class="text_info_music_label">
									<h4>Universal Music Netherlands</h4>
									<p>is the world’s largest music content company with market leading positions in recorded music, music publishing, and merchandising.</p>
									<p>The recorded music business discovers and develops recording artists and then markets and promotes their music across a wide array of formats and platforms. </p>
								</div>

							</div>							
						</div>
					</div>


					<div class="col-sm-4 col-md-12 box_music_label">
						<div class="row">
							<div class="col-md-5">
								<img src="img/musiclabel/4.jpg">								
							</div>
							<div class="col-md-7 bottom_green">
								<div class="text_info_music_label">
									<h4>Universal Music Netherlands</h4>
									<p>is the world’s largest music content company with market leading positions in recorded music, music publishing, and merchandising.</p>
									<p>The recorded music business discovers and develops recording artists and then markets and promotes their music across a wide array of formats and platforms. </p>
								</div>

							</div>							
						</div>
					</div>


							
					
									
				</div>

				
			</div>			
		</div>
		<!-- END:Box content page -->
	
</div>
HTML;

$html['Our Services'] = <<<'HTML'
<div class="site_content">

		<!-- Breadcrumb -->
		<div class="breadcrumb_site breadcrumb_service">
			<div class="container">
				<div class="row">
					<h2>OUR SERVICES</h2>
				</div>
			</div>
		</div>
		<!-- End Breadcrumb -->


		<!-- Box content page -->
		<div class="main_box_content">
			<div class="container">
				<div class="row">	

					<div class="col-md-12">
						<h3 class="title_main_box_content">Providing Music Platforms in the Netherlands, Belgiumv and Luxemburg</h3>
						<p>TargetMusic is a leading provider of music platforms in the Netherlands, Belgium and Luxemburg. Our platforms provide a variety of delivery methods with built in capabilites for online payment processing. Our music catalog encompasses the major record labels, provided a wide variety of international artists and releases as well as renowned local artists. We provide you with the "Data Engine", you provide your customers with your own "Look and Feel".
						</p>													
					</div>

					<div class="col-sm-6 col-md-6  ">
						<div class="media box_service">

							  <div class="media-left">
							    	<img src="img/icon/service_1.png" alt="">
							  </div>

							  <div class="media-body">
							   <h3>Music Streaming </h3>
							   <p>Whether the objective is to provide a complete streaming platform as a dedicated service, or as an add-on to your existing web platform to increase customer retention...</p>
							  </div>

						</div>

					</div>


					<div class="col-sm-6 col-md-6  ">
						<div class="media box_service">

							  <div class="media-left">
							    	<img src="img/icon/service_2.png" alt="">
							  </div>

							  <div class="media-body">
							   <h3> Music Downloads </h3>
							   <p>Digital Music offers your users flexibility and portability. Users can play their music on any device of their choice and whenever they wish.</p>
							  </div>

						</div>

					</div>					
					<div class="hiden-sx height_300">&nbsp;</div>
				</div>

				
			</div>			
		</div>
		<!-- END:Box content page -->
	
</div>
HTML;

$html['Our Technology'] = <<<'HTML'
<div class="site_content">

		<!-- Breadcrumb -->
		<div class="breadcrumb_site breadcrumb_technology">
			<div class="container">
				<div class="row">
					<h2>Our technology</h2>
				</div>
			</div>
		</div>
		<!-- End Breadcrumb -->


		<!-- Box content page -->
		<div class="main_box_content">
			<div class="container">
				<div class="row">	

					<div class="col-md-12">
						<h3 class="title_main_box_content">Objective</h3>
						<p>To provide a media delivery and streaming platform providing high quality and exceptional reliability and uptime. 
This is realized through the combination of state of the art technology and a redundant architecture provide a seamless solution to the objective. 
						</p>													
					</div>


					<div class="col-sm-4 col-md-4 " >
						<div class="technology_item">
							<div class="circle_technology">
								<img src="img/icon/icon_network.png" alt="">
							</div>
							<h3>Network</h3>
							<img src="img/icon/icon_technology.png" alt="">
							<p>Starting with dual 10-Gigabit connections to the Dutch Internet Backbone,	with automatic failover in case one line should fail,	insure reliable customer connections to the network.</p>
							<a href=""><img src="img/icon/readmore.png" alt=""></a>
							<div class="tech_line"></div>
						</div>						
					</div>

					<div class="col-sm-4 col-md-4">
						<div class="technology_item">
							<div class="circle_technology">
								<img src="img/icon/icon_note_and_mouse.png" alt="">
							</div>
							<h3>Hardware</h3>
							<img src="img/icon/icon_technology.png" alt="">
							<p>Whether the objective is to provide a complete streaming platform as a dedicated service, or as an add-on to your existing web platform to increase customer retention...</p>
							<a href=""><img src="img/icon/readmore.png" alt=""></a>
							<div class="tech_line"></div>
						</div>
					</div>

					<div class="col-sm-4 col-md-4 ">
						<div class="technology_item">
							<div class="circle_technology">
								<img src="img/icon/icon_earth.png" alt="">
							</div>
							<h3>Software</h3>
							<img src="img/icon/icon_technology.png" alt="">
							<p>Whether the objective is to provide a complete streaming platform as a dedicated service, or as an add-on to your existing web platform to increase customer retention...</p>
							<a href=""><img src="img/icon/readmore.png" alt=""></a>
						</div>
					</div>

					
					</div>					
				</div>

				
			</div>			
		</div>
		<!-- END:Box content page -->
	
</div>
HTML;

$html['Our Portfolio'] = <<<'HTML'
<div class="site_content">

		<!-- Breadcrumb -->
		<div class="breadcrumb_site breadcrumb_portfolio">
			<div class="container">
				<div class="row">
					<h2>Portfolio</h2>
				</div>
			</div>
		</div>
		<!-- End Breadcrumb -->


		<!-- Box content page -->
		<div class="main_box_content">
			<div class="container">
				<div class="row">	

					<div class="col-md-12">
						<h3 class="title_main_box_content">Portfolio</h3>	
					</div>

					<div class="col-sm-12 col-md-12 no_padding portfolio_box">

						<div class="col-sx-12 col-sm-6 col-md-6 col-lg-4 portfolio_item">
							<span  data-toggle="modal" data-target=".bs-example-modal-lg">
							<i class="fa fa fa-eye"></i></span>
							<img src="img/portfolio/1.jpg">
							<p>Raido 538</p>
							<div class="portfolio_line"></div>
						</div>

						<div class="col-sx-12 col-sm-6 col-md-6 col-lg-4 col-lg-4 portfolio_item">
							<span data-toggle="modal" data-target=".bs-example-modal-lg">
							<i class="fa fa fa-eye"></i></span>
							<img src="img/portfolio/2.jpg">
							<p>Exellent</p>
							<div class="portfolio_line"></div>
						</div>

						<div class="col-sx-12 col-sm-6 col-md-6 col-lg-4 portfolio_item">
							<span data-toggle="modal" data-target=".bs-example-modal-lg">
							<i class="fa fa fa-eye"></i></span>
							<img src="img/portfolio/3.jpg">
							<p>The Voice of Holland</p>
							<div class="portfolio_line"></div>
						</div>

						<div class="col-sx-12 col-sm-6 col-md-6 col-lg-4 portfolio_item">
							<span data-toggle="modal" data-target=".bs-example-modal-lg">
							<i class="fa fa fa-eye"></i></span>
							<img src="img/portfolio/4.jpg">
							<p>Raido 538</p>
							<div class="portfolio_line"></div>
						</div>

						<div class="col-sx-12 col-sm-6 col-md-6 col-lg-4 portfolio_item">
							<span data-toggle="modal" data-target=".bs-example-modal-lg">
							<i class="fa fa fa-eye"></i></span>
							<img src="img/portfolio/5.jpg">
							<p>Exellent</p>
							<div class="portfolio_line"></div>
						</div>

						<div class="col-sx-12 col-sm-6 col-md-6 col-lg-4 portfolio_item">
							<span data-toggle="modal" data-target=".bs-example-modal-lg">
							<i class="fa fa fa-eye"></i></span>
							<img src="img/portfolio/6.jpg">
							<p>The Voice of Holland</p>
							<div class="portfolio_line"></div>
						</div>

						<div class="col-sx-12 col-sm-6 col-md-6 col-lg-4 portfolio_item">
							<span data-toggle="modal" data-target=".bs-example-modal-lg">
							<i class="fa fa fa-eye"></i></span>
							<img src="img/portfolio/7.jpg">
							<p>Raido 538</p>
							<div class="portfolio_line"></div>
						</div>

							
					</div>
			
				

				</div>
			</div>			
		</div>
		<!-- END:Box content page -->
	
</div>



<!-- Popup -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content model_porfolio">
      	<div class="col-md-12"> <a data-dismiss="modal">Close <i class="fa fa-close"></i></a></div>
      	<div class="col-md-7">
      		<img src="img/portfolio/1.jpg" alt="">
      	</div>
      	<div class="col-md-5">
      		<h4>Radio 538</h4>
      		<i>Website Music</i>
      		<div class="portfolio_popup_line">&nbsp;</div>
      		<p>TargetMusic created the complete music download shop for Radio 538. Working closely together with the popular radio station, an innovative and intuitive download website was developed for their targeted audience. In addition to providing the music content for the shop, through our sister company TargetMedia, we also provided a complete payment solution for the users.</p>
      		<button class="btn btn-yellow ">Website</button>
      	</div>
    </div>
  </div>
</div>
<!-- End Popup -->
HTML;

$html['Terms_Conditions'] = <<<'HTML'
<div class="site_content">

		<!-- Breadcrumb -->
		<div class="breadcrumb_site breadcrumb_terms">
			<div class="container">
				<div class="row">
					<h2>Terms & Conditions</h2>
				</div>
			</div>
		</div>
		<!-- End Breadcrumb -->


		<!-- Box content page -->
		<div class="main_box_content">
			<div class="container">
				<div class="row">	

					<div class="col-md-12 terms_content">
						<h4>Terms & Conditions</h4>
						<p>The following Terms & Conditions apply to the use of the TargetMusic website and services. The use of our services is based upon your acceptance and compliance with these rights and obligations.
						</p>



						<h4>Definitions</h4>
						<p>1. TargetMusic is a licensed and registered trade name of TargetMusic B.V. TargetMusic B.V. is a privately held limited liability company with its Headquarters at Huizermaatweg 550A, 1276LM Huizen (The Netherlands). It is registered by the Chamber of Commerce with the Number 32156308 and assigned the VAT Number NL8210.50.540.B.01.
						</p>
						<p>2. Affiliate: Each entity, which has accepted these Terms & Conditions and is accepted by TargetMusic as an Affiliate is authorized to offer mobile services via TargetMusic.</p>
						<p>3. Affiliate site: The affiliate participates with this internet webpage or -pages to the partner program of TargetMusic.</p>



						<h4>Registration and Acceptance</h4>
						<p>1. To register as an Affiliate, this maintains that these Terms & Conditions are accepted and respected.</p>
						<p>2. For Acceptance as an Affiliate it is required that TargetMusic receives the complete registration form within 7 working days after receipt of the acceptance of these Terms & Conditions for confirmation and TargetMusic notifies that they do not accept this registration.</p>
						<p>
3.If TargetMusic does not inform within seven (7) days, after receiving the complete filled out forms with the acceptance of the Terms & Conditions then acceptance of Affiliate will become final.</p>




						<h4>Limitations and Restrictions</h4>
						<p>1. The affiliate will use the delivered content only for the partner program and will not change the content.</p>
						<p>2. Affiliates are not permitted to use this partner program for transactions and/or conduct which conflicts with legal regulations, the netiquette, guidelines of the Advertising Code Committee, the Code of Conduct (Netherlands), the Code of Ethics (Belgium), the agreement or these general Terms and Conditions. Hereunder fall, included but not limited to, the following transactions and behaviours:</p>
						<p>3. spamming: to send unasked large quantities of SMS, containing the same content and/or posting unasked quantities of messages containing the same content on the internet;
Infringement of copyrights and/or other property rights which are inconsistent with the intellectual property rights of third parties;
Misleading of third parties.</p>




						<h4>Commission</h4>
						<p>1. The Affiliate is entitled to a commission, if TargetMusic registers a sale via an Affiliate site. This commission is VAT excluded for Company registered Affiliates. If this is the case, which is in use accordance with the Dutch law, VAT will be calculated over the commission.</p>
						<p>2. The registration of sales, as published on the website of TargetMusic, is stringent to the Affiliate.</p>
						<p>3. The Affiliate permits TargetMusic to generate credit notes for payment of the commission. In case the Affiliate wishes to take care of the invoicing itself, this should be discussed first with TargetMusic.</p>
						<p>4. The payment of the commission will be executed ten (10) weeks after the end of each month at the given Affiliates bank account number. Commission amounts below € 25 (say: twenty five Euros) will not be paid. In case the commission over one month is less then € 25 (say: twenty five Euros), no payment will be done in the month concerned and this amount will be saved. The payment will execute in case the total amount of € 25 (say: twenty five Euros) or more is achieved;</p>
						<p>5. In case of payments to Affiliates (registered outside the Netherlands, the minimum earnings must be over € 50 (say: fifty Euros). In case the commission over one month is less than € 50 (say: fifty Euros), no payment will be done and the commission will be saved. The payment will be executed in the month whereas the total amount of € 50 (say: fifty Euros) or more is achieved. Possible bank costs will be deducted on the amount payable in case these costs are above € 10 (say: ten Euros) per transaction.</p>
						<p>6. The total amount of the commission will be paid every month in retrospect in Euros by TargetMusic. Undiminished by mentioning the relation to the minimal height of the credit balance, the payment will take place within seven (7) working days after the end of the concerning month.</p>

						<h4>Termination</h4>
						<p>1. TargetMusic has the right to terminate this Affiliate agreement at all times, considering a termination period of two (2) weeks. Without prejudice to any other TargetMusic rights, TargetMusic is authorized to end the Affiliate agreement with immediate effect is case of:
The Affiliate infringes with the Terms & Conditions;</p>
						<p>2. The Affiliate has the right to end this agreement at all times, without taking into account the period of termination, unless it is an exclusive agreement next to these Terms & Conditions. Unsubscribing must be done in writing, by using the completed termination form, which needs to be signed off and sent to TargetMusic B.V., Huizermaatweg 550A, 1276LM, Huizen, the Netherlands.</p>
						<p>3. Due to termination, possible commission amounts will be paid by TargetMusic, if the minimum payment amount of € 25, - for Dutch Affiliates and € 50, - for foreign Affiliates is achieved. Outstanding commission amounts will be reported and paid ten (10) weeks after the end of each month and after termination via a credit note. No claims can be done by Affiliate for amounts lower than the minimum amount of payment. These amounts will revert to TargetMusic.</p>


						<h4>Privacy</h4>
						<p>All reported information will be treated with respect and will remain strictly confidential. Neither party will disclose any information to third parties before consulting the other party.
						</p>

						<h4>Liability</h4>
						<p>1. TargetMusic does not accept any damages or losses of the Affiliate or third party for the services offered;</p>
						<p>2. TargetMusic is responsible for 24/7 accessibility of the partner program, except for periodical maintenance, technical disturbances and Force Majeure. TargetMusic is not liable or responsible for any possible loss of turnover or other possible costs which might result from this;</p>
						<p>3. Affiliate warrants that it will meet the obligations required by fiscal legislation and will safeguard TM from of all related claims in this matter.</p>
						<p>4. The Affiliate is solely accuracy for the correctness content of the account data.</p>
						<p>5. TargetMusic is not liable or responsible for delays and/or errors in payments which were caused to wrong or invalid given information.</p>	


						<h4>Other</h4>
						<p>1. The Affiliate is not entitled to accept obligations, is not allowed to express promises or act on behalf of TargetMusic.</p>
						<p>2. The Affiliate is not entitled to transfer the Affiliate agreement to a third party.</p>
						<p>3. TargetMusic is entitled to change these Terms & Conditions at all time. The Affiliate will be notified digitally of these changes. In case of changed Terms & Conditions, which might be unacceptable for the Affiliate, the Affiliate is entitled to end the Affiliate agreement. The Affiliate respects and accepts this changed Affiliate agreement, in case the Affiliate does not end the agreement.</p>

						<p>4. In case any definition of this agreement infringes with appropriate law, this definition will be changed in accordance with the appropriate law by taking into account the purpose of the definition concerned.</p>
						<p>5. The Terms & Conditions are governed by and construed in accordance with the laws of the Netherlands and each party consents to the exclusive jurisdiction of the Dutch courts for adjudication of any disputes arising out of this agreement.</p>	


					</div>


					

					
					</div>					
				</div>

				
			</div>			
		</div>
		<!-- END:Box content page -->
	
</div>
HTML;

$html['Our Partners'] = <<<'HTML'
<div class="site_content">

		<!-- Breadcrumb -->
		<div class="breadcrumb_site breadcrumb_partner">
			<div class="container">
				<div class="row">
					<h2>Our Partners</h2>
				</div>
			</div>
		</div>
		<!-- End Breadcrumb -->


		<!-- Box content page -->
		<div class="main_box_content">
			<div class="container">
				<div class="row">	

					<div class="col-md-12">
						<h3 class="title_main_box_content">To provide the best reliability and quality we have teamed up with technology
						leaders in Hardware, Software and Systems support.</h3>	
					</div>

					

								
					<div class="col-sm-4 col-md-4 margin_top_50">
						
							<div class="col-md-12 parter_item"
							data-toggle="popover"
							title="Popover title"
							data-placement="top"
							data-content="High Quality IP Transit and Remote Peering
Atrato IP Networks is a leading provider of high quality IP transit, carrier services, remote peering and managed services. With a customer base comprising telcos, ISPs and hosting companies, Atrato develops its network to support these demanding, high traffic businesses well in advance of projected bandwidth growth. <br><br> <button class='btn-yellow'>Website</button>">
								<img src="img/partner/dell.png" alt="">
								<img src="img/bg_box_partner.png" alt="">
							</div>	
						
							<div class="col-md-12 parter_item"
							data-toggle="popover"
							title="Popover title"
							data-placement="top"
							data-content="High Quality IP Transit and Remote Peering
Atrato IP Networks is a leading provider of high quality IP transit, carrier services, remote peering and managed services. With a customer base comprising telcos, ISPs and hosting companies, Atrato develops its network to support these demanding, high traffic businesses well in advance of projected bandwidth growth. <br><br> <button class='btn-yellow'>Website</button>">
								<img src="img/partner/emc.png" alt="">
								<img src="img/bg_box_partner.png" alt="">
							</div>	

							<div class="col-md-12 parter_item"
							data-toggle="popover"
							title="Popover title"
							data-placement="top"
							data-content="High Quality IP Transit and Remote Peering
Atrato IP Networks is a leading provider of high quality IP transit, carrier services, remote peering and managed services. With a customer base comprising telcos, ISPs and hosting companies, Atrato develops its network to support these demanding, high traffic businesses well in advance of projected bandwidth growth. <br><br> <button class='btn-yellow'>Website</button>">
								<img src="img/partner/teling.png" alt="">
								<img src="img/bg_box_partner.png" alt="">
							</div>								

					</div>
					<!-- ENd column left -->

					<div class="col-sm-4 col-md-4 margin_top_50 partner_center" >

							<div class="col-md-12 parter_item"data-toggle="popover"
							title="Popover title"
							data-placement="top"
							data-content="High Quality IP Transit and Remote Peering
Atrato IP Networks is a leading provider of high quality IP transit, carrier services, remote peering and managed services. With a customer base comprising telcos, ISPs and hosting companies, Atrato develops its network to support these demanding, high traffic businesses well in advance of projected bandwidth growth. <br><br> <button class='btn-yellow'>Website</button>">
								<img src="img/partner/emc.png" alt="">
								<img src="img/bg_box_partner.png" alt="">
							</div>	

							<div class="col-md-12 parter_item"data-toggle="popover"
							title="Popover title"
							data-placement="top"
							data-content="High Quality IP Transit and Remote Peering
Atrato IP Networks is a leading provider of high quality IP transit, carrier services, remote peering and managed services. With a customer base comprising telcos, ISPs and hosting companies, Atrato develops its network to support these demanding, high traffic businesses well in advance of projected bandwidth growth. <br><br> <button class='btn-yellow'>Website</button>">
								<img src="img/partner/dell.png" alt="">
								<img src="img/bg_box_partner.png" alt="">
							</div>	
						
							

							<div class="col-md-12 parter_item"data-toggle="popover"
							title="Popover title"
							data-placement="top"
							data-content="High Quality IP Transit and Remote Peering
Atrato IP Networks is a leading provider of high quality IP transit, carrier services, remote peering and managed services. With a customer base comprising telcos, ISPs and hosting companies, Atrato develops its network to support these demanding, high traffic businesses well in advance of projected bandwidth growth. <br><br> <button class='btn-yellow'>Website</button>">
								<img src="img/partner/teling.png" alt="">
								<img src="img/bg_box_partner.png" alt="">
							</div>			
					</div>
					<!-- End Column Center -->

					<div class="col-sm-4 col-md-4 margin_top_50" >							

							<div class="col-md-12 parter_item"data-toggle="popover"
							title="Popover title"
							data-placement="top"
							data-content="High Quality IP Transit and Remote Peering
Atrato IP Networks is a leading provider of high quality IP transit, carrier services, remote peering and managed services. With a customer base comprising telcos, ISPs and hosting companies, Atrato develops its network to support these demanding, high traffic businesses well in advance of projected bandwidth growth. <br><br> <button class='btn-yellow'>Website</button>">
								<img src="img/partner/dell.png" alt="">
								<img src="img/bg_box_partner.png" alt="">
							</div>		

							<div class="col-md-12 parter_item"data-toggle="popover"
							title="Popover title"
							data-placement="top"
							data-content="High Quality IP Transit and Remote Peering
Atrato IP Networks is a leading provider of high quality IP transit, carrier services, remote peering and managed services. With a customer base comprising telcos, ISPs and hosting companies, Atrato develops its network to support these demanding, high traffic businesses well in advance of projected bandwidth growth. <br><br> <button class='btn-yellow'>Website</button>">
								<img src="img/partner/teling.png" alt="">
								<img src="img/bg_box_partner.png" alt="">
							</div>	

							<div class="col-md-12 parter_item"data-toggle="popover"
							title="Popover title"
							data-placement="top"
							data-content="High Quality IP Transit and Remote Peering
Atrato IP Networks is a leading provider of high quality IP transit, carrier services, remote peering and managed services. With a customer base comprising telcos, ISPs and hosting companies, Atrato develops its network to support these demanding, high traffic businesses well in advance of projected bandwidth growth. <br><br> <button class='btn-yellow'>Website</button>">
								<img src="img/partner/emc.png" alt="">
								<img src="img/bg_box_partner.png" alt="">
							</div>		
					</div>
					
					<!-- End Column Right -->

					
									
				</div>

				
			</div>			
		</div>
		<!-- END:Box content page -->
	
</div>
<script type="text/javascript">
		setTimeout(function () {

		$('[data-toggle="popover"]').popover({
			trigger: 'click',			
			html: true
		});

	 	

	}, 1000)
</script>
HTML;

$html['Download'] = <<<'HTML'
<div class="site_content">

		<!-- Breadcrumb -->
		<div class="breadcrumb_site breadcrumb_service">
			<div class="container">
				<div class="row">
					<h2>OUR SERVICES</h2>
				</div>
			</div>
		</div>
		<!-- End Breadcrumb -->


		<!-- Box content page -->
		<div class="main_box_content">
			<div class="container">
				<div class="row">	

					<div class="col-md-12">
						<h3 class="title_main_box_content">Digital Music Downloads</h3>																		
					</div>

					<div class="col-sm-7 col-md-7 justify ">

						<p>Digital Music offers your users flexibility and portability. Users can play their music on any device of their choice and whenever they wish.</p>

						<p>Our music download platform provides users the ability to download invidual tracks or complete albums, with full preview capabilities for each track. Every track does not use DRM <span class="hight_line_red"> (Digital Rights Management) </span> encryption, allowing it to be played on PCs, mp3 Players, Smartphones, Tablets, etc.</p>

						<p>The download not only includes the track but any related artwork and compressed into a zip file for quicker download and installation on any operating system. All downloads are completely legal as the sale price includes all required licensing payments (label company and regulatory agencies).</p>

						<p>Our platform allows you to offer a complete music library to your customers. It is also possible to use subsets to target the available music to specific user groups, or even to promote isolated tracks for special events. Our automated systems provide real time execution of all transactions eliminating the back office paperwork.</p>

						<p>With our API the functionality is easy to integrate into your website. For dedicated custom sites, we also offer a complete package incorporating your design objectives into a finished product. A sample of our download platform can be seen <a class="hight_line_red" href="">here</a>.</p>

					</div>


					<div class="col-sm-5 col-md-5 text_center ">
						<img src="img/service_download.png" alt="">
					</div>					
					<div class="hiden-sx height_300">&nbsp;</div>
				</div>

				
			</div>			
		</div>
		<!-- END:Box content page -->
	
</div>
HTML;

$html['Streaming'] = <<<'HTML'
<div class="site_content">

		<!-- Breadcrumb -->
		<div class="breadcrumb_site breadcrumb_service">
			<div class="container">
				<div class="row">
					<h2>OUR SERVICES</h2>
				</div>
			</div>
		</div>
		<!-- End Breadcrumb -->


		<!-- Box content page -->
		<div class="main_box_content">
			<div class="container">
				<div class="row">	

					<div class="col-md-12">
						<h3 class="title_main_box_content">Music Streaming</h3>																		
					</div>

					<div class="col-sm-12 col-md-7 justify ">

						<p>Whether the objective is to provide a complete streaming platform as a dedicated service, or as an add-on to your existing web platform to increase customer retention, our music streaming platform is the ideal solution.</p>

						<p>It provides the ability to allow your customer to play streams without having to install any special software on the PC or install special applications on smartphones. This is possible through the use of HTML5 in modern browsers connecting to our API. Your time to market and implementation times are thereby drastically reduced. The API also supports integration with smartphone applications.</p>

						<p>Through the flexibility built into our API, we can also maintain individual user accounts allowing for detailed tracking of music selection and playback patterns. As an alternative it can permit your website to provide the user authtification to our streaming system. Detailed usage information is still available through the use of session IDs. <br>
It also assists in the attraction of new users by offering previews on a per track basis. To help build customer loyalty, social networking functions are also built in. These allow the user to create groups, share playlists, etc.</p>

						<p>For promotional applications we also offer the ability to use pre-assigned tokens. The tokens can be distributed as part of your advertising campaign and allow the user to play the predefined track without any registration requirements. Ideal for seasonal promotions, special events or targeted marketing campaigns.</p>

						<p>
Our Music Streaming platform not only supports a range of stream types but also at different playback speeds. This makes it ideal for both home, office and mobile applications. Reliability is a critical factor in the design and more over the technology can be found under <a href="#" class="hight_line_red">Our Technology</a> .
</p>


 				<p>An example of our API and HTML5 in use is <a class="hight_line_red" href="#">here</a> .</p>

					</div>


					<div class="col-sm-12 col-md-5 text_center ">
						<img src="img/music_streaming.png" alt="">
					</div>					
					<div class="hiden-sx height_300">&nbsp;</div>
				</div>

				
			</div>			
		</div>
		<!-- END:Box content page -->
	
</div>
HTML;

$html['New Releases'] = <<<'HTML'
<div class="site_content">

		<!-- Breadcrumb -->
		<div class="breadcrumb_site breadcrumb_service">
			<div class="container">
				<div class="row">
					<h2>New Releases</h2>
				</div>
			</div>
		</div>
		<!-- End Breadcrumb -->


		<!-- Box content page -->
		<div class="main_box_content">
			<div class="container">
				<div class="row">	

					<div class="col-md-12">
						<h3 class="title_main_box_content">These are the latest new releases from the label companies. It also shows the ease of implementation this information into an existing web design, including the ablity to preview and purchase.</h3>
																			
					</div>

					<div class="col-md-12 new_relase" >
						<div class="row">
							<div class="col-sm-5 col-md-5">
								<img src="img/new_release/1.jpg" alt="">
								<div class="new_relase_list_btn">
									<button class="btn btn-md btn-red " data-toggle="modal" data-target=".bs-example-modal-lg">
										<i class="fa fa-file-sound-o"></i> Preview
									</button>
									<button class="btn btn-md  btn-yellow pull-right">
										<i class="fa fa-cloud-download"></i>
										Download
									</button>
								</div>
								
							</div>
							<div class="col-sm-7 col-md-7">
								<table class="table">	
									<thead>
										<tr>
											<th>Album info: 	</th>
											<th>GIRL</th>
										</tr>
									</thead>								
									<tbody>	
										<tr>
											<td>Titel info:</td>
											<td>GIRL</td>
										</tr>
										<tr>
											<td>Artiest: 	</td>
											<td>Pharrell Williams</td>
										</tr>
										<tr>
											<td>Label info:: 	</td>
											<td>Columbia </td>
										</tr>
										<tr>
											<td colspan="2" class="no_border_bottom">
												The #538DanceSmash album is a household name in the Netherlands . The 2nd volume of 2014 is out now! As always, the album is loaded with the biggest dance hits of the moment, by artists such as #CalvinHarris, #Avicii, #Afrojack, #Hardwell, #ArminVanBuuren, #DavidGuetta, #Sigma & #MartinGarrix!
											</td>
										</tr>

									</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- End a box -->


					<div class="col-md-12 new_relase" >
						<div class="row">
							<div class="col-sm-5 col-md-5">
								<img src="img/new_release/2.jpg" alt="">
								<div class="new_relase_list_btn">
									<button class="btn btn-md btn-red " data-toggle="modal" data-target=".bs-example-modal-lg">
										<i class="fa fa-file-sound-o"></i> Preview
									</button>
									<button class="btn btn-md  btn-yellow pull-right">
										<i class="fa fa-cloud-download"></i>
										Download
									</button>
								</div>
								
							</div>
							<div class="col-sm-7 col-md-7">
								<table class="table">	
									<thead>
										<tr>
											<th>Album info: 	</th>
											<th>GIRL</th>
										</tr>
									</thead>								
									<tbody>	
										<tr>
											<td>Titel info:</td>
											<td>GIRL</td>
										</tr>
										<tr>
											<td>Artiest: 	</td>
											<td>Pharrell Williams</td>
										</tr>
										<tr>
											<td>Label info:: 	</td>
											<td>Columbia </td>
										</tr>
										<tr>
											<td colspan="2" class="no_border_bottom">
												The #538DanceSmash album is a household name in the Netherlands . The 2nd volume of 2014 is out now! As always, the album is loaded with the biggest dance hits of the moment, by artists such as #CalvinHarris, #Avicii, #Afrojack, #Hardwell, #ArminVanBuuren, #DavidGuetta, #Sigma & #MartinGarrix!
											</td>
										</tr>

									</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- End a box -->


					<div class="col-md-12 new_relase" >
						<div class="row">
							<div class="col-sm-5 col-md-5">
								<img src="img/new_release/3.jpg" alt="">
								<div class="new_relase_list_btn">
									<button class="btn btn-md btn-red " data-toggle="modal" data-target=".modal">
										<i class="fa fa-file-sound-o"></i> Preview
									</button>
									<button class="btn btn-md  btn-yellow pull-right">
										<i class="fa fa-cloud-download"></i>
										Download
									</button>
								</div>
								
							</div>
							<div class="col-sm-7 col-md-7">
								<table class="table">	
									<thead>
										<tr>
											<th>Album info: 	</th>
											<th>GIRL</th>
										</tr>
									</thead>								
									<tbody>	
										<tr>
											<td>Titel info:</td>
											<td>GIRL</td>
										</tr>
										<tr>
											<td>Artiest: 	</td>
											<td>Pharrell Williams</td>
										</tr>
										<tr>
											<td>Label info:: 	</td>
											<td>Columbia </td>
										</tr>
										<tr>
											<td colspan="2" class="no_border_bottom">
												The #538DanceSmash album is a household name in the Netherlands . The 2nd volume of 2014 is out now! As always, the album is loaded with the biggest dance hits of the moment, by artists such as #CalvinHarris, #Avicii, #Afrojack, #Hardwell, #ArminVanBuuren, #DavidGuetta, #Sigma & #MartinGarrix!
											</td>
										</tr>

									</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- End a box -->


					<div class="col-md-12 new_relase" >
						<div class="row">
							<div class="col-sm-5 col-md-5">
								<img src="img/new_release/4.jpg" alt="">
								<div class="new_relase_list_btn">
									<button class="btn btn-md btn-red " data-toggle="modal" data-target=".bs-example-modal-lg">
										<i class="fa fa-file-sound-o"></i> Preview
									</button>
									<button class="btn btn-md  btn-yellow pull-right">
										<i class="fa fa-cloud-download"></i>
										Download
									</button>
								</div>
								
							</div>
							<div class="col-sm-7 col-md-7">
								<table class="table">	
									<thead>
										<tr>
											<th>Album info: 	</th>
											<th>GIRL</th>
										</tr>
									</thead>								
									<tbody>	
										<tr>
											<td>Titel info:</td>
											<td>GIRL</td>
										</tr>
										<tr>
											<td>Artiest: 	</td>
											<td>Pharrell Williams</td>
										</tr>
										<tr>
											<td>Label info:: 	</td>
											<td>Columbia </td>
										</tr>
										<tr>
											<td colspan="2" class="no_border_bottom">
												The #538DanceSmash album is a household name in the Netherlands . The 2nd volume of 2014 is out now! As always, the album is loaded with the biggest dance hits of the moment, by artists such as #CalvinHarris, #Avicii, #Afrojack, #Hardwell, #ArminVanBuuren, #DavidGuetta, #Sigma & #MartinGarrix!
											</td>
										</tr>

									</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- End a box -->



									
					<div class="hiden-sx height_300">&nbsp;</div>
				</div>

				
			</div>			
		</div>
		<!-- END:Box content page -->


		<!-- Popup -->
		<div class="modal fade bs-example-modal-lg " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-md">
			    <div class="modal-content popup_new_release">
			      	<div data-dismiss="modal" class="close_popup" >
			      		<i class="fa fa-close"></i>
			      	</div>
				    <div class="row">
				    	<div class="col-xs-4 col-sm-4 col-md-4">
				    		<img src="img/new_release/avatar-1.jpg" alt="">
				    	</div>
				    	<div class="col-xs-8 col-sm-8 col-md-8">
						    	<table>						    		
						    		<tbody>						    		
						    			<tr>
						    				<td class="fix_mobile">Title:</td>
						    				<td>538 Dance Smash 2014, Vol. 2</td>
						    			</tr>
						    			<tr>
						    				<td>Artist: </td>
						    				<td>Various Artists</td>
						    			</tr>
						    		</tbody>
						    	</table>						
				    	</div>

				    	<div class="col-xs-12 col-sm-12 col-md-12 ">
				    		<div class="player_release display-table">
					    						    		
					    		    <span class="fa fa-backward"></span>
					    			<span class="btn_play fa fa-play played"></span>
					    			<span class="fa fa fa-forward"></span>
								

<!-- 
				    			<i class="fa fa-backward"></i>
				    			<i class="fa fa-play"></i>
				    			<i class="fa fa fa-forward"></i> -->
				    		</div>
				    	</div>

				    	<div class="col-xs-12 col-sm-12 col-md-12">
					    		<ul class="list-group popup_new_release_list_item">

								  <li class="list-group-item new_release_active">
								 	 <i class="fa fa-pause"></i>
								  	1 | Cras justo odioras justo odio  justo odio
								  </li>
								 <li class="list-group-item">
								 	 <i class="fa fa-play"></i>
								  	2 | Cras justo odio
								  </li>
								  <li class="list-group-item">
								 	 <i class="fa fa-play"></i>
								  	3 | Cras justo odioras justo odio  justo odio
								  </li>

								  <li class="list-group-item">
								 	 <i class="fa fa-play"></i>
								  	4 | Cras justo odioras justo odio  justo odio
								  </li>

								  <li class="list-group-item">
								 	 <i class="fa fa-play"></i>
								  	5 | Cras justo odioras justo odio  justo odio
								  </li>

								  <li class="list-group-item">
								 	 <i class="fa fa-play"></i>
								  	6 | Cras justo odioras justo odio  justo odio
								  </li>

								  <li class="list-group-item">
								 	 <i class="fa fa-play"></i>
								  	7 | Cras justo odioras justo odio  justo odio
								  </li>
								  <li class="list-group-item">
								 	 <i class="fa fa-play"></i>
								  	8 | Cras justo odioras justo odio  justo odio
								  </li>
								</ul>
				    	</div>
				    </div>

			    </div>
			  </div>
			</div>

		<!-- End popup -->
	
</div>
HTML;

$html['Terms_Conditions'] = <<<'HTML'
<div class="site_content">

		<!-- Breadcrumb -->
		<div class="breadcrumb_site breadcrumb_terms">
			<div class="container">
				<div class="row">
					<h2>Terms & Conditions</h2>
				</div>
			</div>
		</div>
		<!-- End Breadcrumb -->


		<!-- Box content page -->
		<div class="main_box_content">
			<div class="container">
				<div class="row">	

					<div class="col-md-12 terms_content">
						<h4>Terms & Conditions</h4>
						<p>The following Terms & Conditions apply to the use of the TargetMusic website and services. The use of our services is based upon your acceptance and compliance with these rights and obligations.
						</p>



						<h4>Definitions</h4>
						<p>1. TargetMusic is a licensed and registered trade name of TargetMusic B.V. TargetMusic B.V. is a privately held limited liability company with its Headquarters at Huizermaatweg 550A, 1276LM Huizen (The Netherlands). It is registered by the Chamber of Commerce with the Number 32156308 and assigned the VAT Number NL8210.50.540.B.01.
						</p>
						<p>2. Affiliate: Each entity, which has accepted these Terms & Conditions and is accepted by TargetMusic as an Affiliate is authorized to offer mobile services via TargetMusic.</p>
						<p>3. Affiliate site: The affiliate participates with this internet webpage or -pages to the partner program of TargetMusic.</p>



						<h4>Registration and Acceptance</h4>
						<p>1. To register as an Affiliate, this maintains that these Terms & Conditions are accepted and respected.</p>
						<p>2. For Acceptance as an Affiliate it is required that TargetMusic receives the complete registration form within 7 working days after receipt of the acceptance of these Terms & Conditions for confirmation and TargetMusic notifies that they do not accept this registration.</p>
						<p>
3.If TargetMusic does not inform within seven (7) days, after receiving the complete filled out forms with the acceptance of the Terms & Conditions then acceptance of Affiliate will become final.</p>




						<h4>Limitations and Restrictions</h4>
						<p>1. The affiliate will use the delivered content only for the partner program and will not change the content.</p>
						<p>2. Affiliates are not permitted to use this partner program for transactions and/or conduct which conflicts with legal regulations, the netiquette, guidelines of the Advertising Code Committee, the Code of Conduct (Netherlands), the Code of Ethics (Belgium), the agreement or these general Terms and Conditions. Hereunder fall, included but not limited to, the following transactions and behaviours:</p>
						<p>3. spamming: to send unasked large quantities of SMS, containing the same content and/or posting unasked quantities of messages containing the same content on the internet;
Infringement of copyrights and/or other property rights which are inconsistent with the intellectual property rights of third parties;
Misleading of third parties.</p>




						<h4>Commission</h4>
						<p>1. The Affiliate is entitled to a commission, if TargetMusic registers a sale via an Affiliate site. This commission is VAT excluded for Company registered Affiliates. If this is the case, which is in use accordance with the Dutch law, VAT will be calculated over the commission.</p>
						<p>2. The registration of sales, as published on the website of TargetMusic, is stringent to the Affiliate.</p>
						<p>3. The Affiliate permits TargetMusic to generate credit notes for payment of the commission. In case the Affiliate wishes to take care of the invoicing itself, this should be discussed first with TargetMusic.</p>
						<p>4. The payment of the commission will be executed ten (10) weeks after the end of each month at the given Affiliates bank account number. Commission amounts below € 25 (say: twenty five Euros) will not be paid. In case the commission over one month is less then € 25 (say: twenty five Euros), no payment will be done in the month concerned and this amount will be saved. The payment will execute in case the total amount of € 25 (say: twenty five Euros) or more is achieved;</p>
						<p>5. In case of payments to Affiliates (registered outside the Netherlands, the minimum earnings must be over € 50 (say: fifty Euros). In case the commission over one month is less than € 50 (say: fifty Euros), no payment will be done and the commission will be saved. The payment will be executed in the month whereas the total amount of € 50 (say: fifty Euros) or more is achieved. Possible bank costs will be deducted on the amount payable in case these costs are above € 10 (say: ten Euros) per transaction.</p>
						<p>6. The total amount of the commission will be paid every month in retrospect in Euros by TargetMusic. Undiminished by mentioning the relation to the minimal height of the credit balance, the payment will take place within seven (7) working days after the end of the concerning month.</p>

						<h4>Termination</h4>
						<p>1. TargetMusic has the right to terminate this Affiliate agreement at all times, considering a termination period of two (2) weeks. Without prejudice to any other TargetMusic rights, TargetMusic is authorized to end the Affiliate agreement with immediate effect is case of:
The Affiliate infringes with the Terms & Conditions;</p>
						<p>2. The Affiliate has the right to end this agreement at all times, without taking into account the period of termination, unless it is an exclusive agreement next to these Terms & Conditions. Unsubscribing must be done in writing, by using the completed termination form, which needs to be signed off and sent to TargetMusic B.V., Huizermaatweg 550A, 1276LM, Huizen, the Netherlands.</p>
						<p>3. Due to termination, possible commission amounts will be paid by TargetMusic, if the minimum payment amount of € 25, - for Dutch Affiliates and € 50, - for foreign Affiliates is achieved. Outstanding commission amounts will be reported and paid ten (10) weeks after the end of each month and after termination via a credit note. No claims can be done by Affiliate for amounts lower than the minimum amount of payment. These amounts will revert to TargetMusic.</p>


						<h4>Privacy</h4>
						<p>All reported information will be treated with respect and will remain strictly confidential. Neither party will disclose any information to third parties before consulting the other party.
						</p>

						<h4>Liability</h4>
						<p>1. TargetMusic does not accept any damages or losses of the Affiliate or third party for the services offered;</p>
						<p>2. TargetMusic is responsible for 24/7 accessibility of the partner program, except for periodical maintenance, technical disturbances and Force Majeure. TargetMusic is not liable or responsible for any possible loss of turnover or other possible costs which might result from this;</p>
						<p>3. Affiliate warrants that it will meet the obligations required by fiscal legislation and will safeguard TM from of all related claims in this matter.</p>
						<p>4. The Affiliate is solely accuracy for the correctness content of the account data.</p>
						<p>5. TargetMusic is not liable or responsible for delays and/or errors in payments which were caused to wrong or invalid given information.</p>	


						<h4>Other</h4>
						<p>1. The Affiliate is not entitled to accept obligations, is not allowed to express promises or act on behalf of TargetMusic.</p>
						<p>2. The Affiliate is not entitled to transfer the Affiliate agreement to a third party.</p>
						<p>3. TargetMusic is entitled to change these Terms & Conditions at all time. The Affiliate will be notified digitally of these changes. In case of changed Terms & Conditions, which might be unacceptable for the Affiliate, the Affiliate is entitled to end the Affiliate agreement. The Affiliate respects and accepts this changed Affiliate agreement, in case the Affiliate does not end the agreement.</p>

						<p>4. In case any definition of this agreement infringes with appropriate law, this definition will be changed in accordance with the appropriate law by taking into account the purpose of the definition concerned.</p>
						<p>5. The Terms & Conditions are governed by and construed in accordance with the laws of the Netherlands and each party consents to the exclusive jurisdiction of the Dutch courts for adjudication of any disputes arising out of this agreement.</p>	


					</div>


					

					
					</div>					
				</div>

				
			</div>			
		</div>
		<!-- END:Box content page -->
	
</div>
HTML;

$html['Disclaimer'] = <<<'HTML'
<div class="site_content">

		<!-- Breadcrumb -->
		<div class="breadcrumb_site breadcrumb_terms">
			<div class="container">
				<div class="row">
					<h2>Disclaimer</h2>
				</div>
			</div>
		</div>
		<!-- End Breadcrumb -->


		<!-- Box content page -->
		<div class="main_box_content">
			<div class="container">
				<div class="row">	

					<div class="col-md-12 terms_content">
						<h4>Copyright</h4>
						<p>TargetMusic is a licensed trade name of TargetMusic B.V., The Netherlands.</p>
						<p>© Copyright TargetMusic B.V. All rights reserved worldwide.</p>



						<h4>Disclaimer</h4>
						<p>The publisher, TargetMusic B.V., cannot be held responsible for any damage, material or immaterial, direct or indirect, caused by the contents of the information provided by a third party on its websites or in SMS/MMS and e-mail messages. This includes but is not limited to copyright infringements or any other intellectual property issues.</p>

						<p>The music content offered by TargetMusic B.V. is subject to copyright protection. Copyright and other required fees are paid for musical works as applicable.</p>

					</div>


					

					
					</div>					
				</div>

				
			</div>			
		</div>
		<!-- END:Box content page -->
	
</div>
HTML;

        $pages_array = [
            ['Index', 'published', NULL, 0, NULL, '2015-05-26 12:00:00', '2015-05-26 12:00:00', NULL, 0.1],
            ['About us', 'published', NULL, 0, NULL, '2015-05-26 12:00:00', '2015-05-26 12:00:00', NULL, 0.1],
            ['Music Labels', 'published', NULL, 0, NULL, '2015-05-26 12:00:00', '2015-05-26 12:00:00', NULL, 0.1],
            ['Our Services', 'published', NULL, 0, NULL, '2015-05-26 12:00:00', '2015-05-26 12:00:00', NULL, 0.1],
            ['Our Technology', 'published', NULL, 0, NULL, '2015-05-26 12:00:00', '2015-05-26 12:00:00', NULL, 0.1],
            ['Our Portfolio', 'published', NULL, 0, NULL, '2015-05-26 12:00:00', '2015-05-26 12:00:00', NULL, 0.1],
            ['Our Partners', 'published', NULL, 0, NULL, '2015-05-26 12:00:00', '2015-05-26 12:00:00', NULL, 0.1],
            ['Download', 'published', NULL, 0, NULL, '2015-05-26 12:00:00', '2015-05-26 12:00:00', NULL, 0.1],
            ['Streaming', 'published', NULL, 0, NULL, '2015-05-26 12:00:00', '2015-05-26 12:00:00', NULL, 0.1],
            ['New Releases', 'published', NULL, 0, NULL, '2015-05-26 12:00:00', '2015-05-26 12:00:00', NULL, 0.1],
            ['Terms_Conditions', 'published', NULL, 0, NULL, '2015-05-26 12:00:00', '2015-05-26 12:00:00', NULL, 0.1],
            ['Disclaimer', 'published', NULL, 0, NULL, '2015-05-26 12:00:00', '2015-05-26 12:00:00', NULL, 0.1],
        ];
        $array_keys = ['key', 'status', 'publish_date', 'sort_order', 'parent_id', 'created', 'modified', 'user_id', 'version'];
        
        $page_content_array = [
            "Index" => ['Homepage', $html["Index"], $languageID, '', '2015-05-26 12:00:00', '2015-05-26 12:00:00'],
            "About us" => ['About us', $html["About us"], $languageID, '', '2015-05-26 12:00:00', '2015-05-26 12:00:00'],
            "Music Labels" => ['Music Labels', $html["Music Labels"], $languageID, '', '2015-05-26 12:00:00', '2015-05-26 12:00:00'],
            "Our Services" => ['Our Services', $html["Our Services"], $languageID, '', '2015-05-26 12:00:00', '2015-05-26 12:00:00'],
            "Our Technology" => ['Our Technology', $html["Our Technology"], $languageID, '', '2015-05-26 12:00:00', '2015-05-26 12:00:00'],
            "Our Portfolio" => ['Our Portfolio', $html["Our Portfolio"], $languageID, '', '2015-05-26 12:00:00', '2015-05-26 12:00:00'],
            "Our Partners" => ['Our Partners', $html["Our Partners"], $languageID, '', '2015-05-26 12:00:00', '2015-05-26 12:00:00'],
            "Download" => ['Digital Music Download', $html["Download"], $languageID, '', '2015-05-26 12:00:00', '2015-05-26 12:00:00'],
            "Streaming" => ['Music Streaming', $html["Streaming"], $languageID, '', '2015-05-26 12:00:00', '2015-05-26 12:00:00'],
            "New Releases" => ['New Releases', $html["New Releases"], $languageID, '', '2015-05-26 12:00:00', '2015-05-26 12:00:00'],
            "Terms_Conditions" => ['Terms & Conditions', $html["Terms_Conditions"], $languageID, '', '2015-05-26 12:00:00', '2015-05-26 12:00:00'],
            "Disclaimer" => ['Disclaimer', $html["Disclaimer"], $languageID, '', '2015-05-26 12:00:00', '2015-05-26 12:00:00'],
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

    public function safeDown()
    {
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
