<h1>newsapi</h1>


[TOC]

## 注册接口

#### 请求地址: (post)

     http://newsapi.revanow.com/api/register

#### 请求格式  
	{"source_id":"123456","phone_type":"nokia","resolution":"1234*123"}     

#### 返回格式

     {"code":200,"message":"OK","result_object":{"status":0,"name":null,"gender":null,"registered":0,"atype":2,"source":"android:lewa","token":"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VybmFtZSI6ImFuZHJvaWQ6bGV3YV8xMjM0NTYiLCJhY2NvdW50X3R5cGUiOjIsInVzZXJfaWQiOiI1NzUxM2FmMDEyYzFmYjczZDVhNWRjMmYiLCJleHAiOjE0NzMxNDYxNjB9.2i8fJ6CdzM1G1d9Bfkw1Z1Zt8hFEQYLYtVp371UkQTo","avatar":[],"id":"57513af012c1fb73d5a5dc2f"}}


## 分类接口

#### 请求地址: (get)

	http://newsapi.revanow.com/api/catagory

#### 返回格式 

	{"code":200,"message":"OK","result_array":[{"id":0,"catagory":"rec","title":"For you"},{"id":1,"catagory":"youtubes","title":"Videos"},{"id":2,"catagory":"jokes","title":"Photos"},{"id":3,"catagory":"videos","title":"GIFs"},{"id":4,"catagory":"entertainment","title":"Entertainment"},{"id":5,"catagory":"local","title":"Local"},{"id":6,"catagory":"cricket","title":"Cricket"},{"id":7,"catagory":"politics","title":"Politics"},{"id":8,"catagory":"technology","title":"Technology"},{"id":9,"catagory":"health","title":"Health"},{"id":10,"catagory":"lifestyle","title":"Lifestyle"},{"id":11,"catagory":"sports","title":"Sports"},{"id":12,"catagory":"education","title":"Education"},{"id":13,"catagory":"business","title":"Business"},{"id":14,"catagory":"national","title":"National"},{"id":15,"catagory":"world","title":"World"},{"id":16,"catagory":"auto","title":"Auto"},{"id":17,"catagory":"subscribe","title":"Subscribed"}]}

## list接口

#### 请求地址: (post)

	http://newsapi.revanow.com/api/102

#### 请求格式  
	{"categories":"","action":"","token":"","read_tag":""}

#### 返回格式  

     {"code":200,"message":"OK","result_array":[{"top_images":[{"origin":"http:\/\/image.newsdog.today\/origin_93bdbee944d2190964bbc7f2513dc1e6","source":"http:\/\/d1s8mqgwixvb29.cloudfront.net\/article\/article_extra_large_image\/3161461751204solar-power-station.jpg","thumb_height":133,"thumb":"http:\/\/image.newsdog.today\/thumb_93bdbee944d2190964bbc7f2513dc1e6","thumb_width":200,"width":510,"height":340}],"related_images":[{"origin":"http:\/\/image.newsdog.today\/origin_93bdbee944d2190964bbc7f2513dc1e6","source":"http:\/\/d1s8mqgwixvb29.cloudfront.net\/article\/article_extra_large_image\/3161461751204solar-power-station.jpg","thumb_height":133,"thumb":"http:\/\/image.newsdog.today\/thumb_93bdbee944d2190964bbc7f2513dc1e6","thumb_width":200,"width":510,"height":340}],"title":"BW Smart Cities","seq_id":33453316,"is_hot":0,"site_url":"bwsmartcities.businessworld.in","source":"BW","published_at":"2016-06-08 00:00:00","comments_count":null,"has_commented":false,"op_recommend":false,"source_url":"http:\/\/bwsmartcities.businessworld.in\/article\/Government-Announces-Policy-to-Make-Delhi-Solar-City-\/08-06-2016-98925\/","type":"article","id":"5757c4281290715d4a3910e1"},{"top_images":[{"origin":"http:\/\/image.newsdog.today\/origin_0578e6690ea916b8c0fc4aef17d1a54d","source":"http:\/\/www.dailypioneer.com\/uploads\/main\/mn_story_image\/T330_134952_Untitled-2.gif","thumb_height":141,"thumb":"http:\/\/image.newsdog.today\/thumb_0578e6690ea916b8c0fc4aef17d1a54d","thumb_width":200,"width":330,"height":232}],"related_images":[{"origin":"http:\/\/image.newsdog.today\/origin_0578e6690ea916b8c0fc4aef17d1a54d","source":"http:\/\/www.dailypioneer.com\/uploads\/main\/mn_story_image\/T330_134952_Untitled-2.gif","thumb_height":141,"thumb":"http:\/\/image.newsdog.today\/thumb_0578e6690ea916b8c0fc4aef17d1a54d","thumb_width":200,"width":330,"height":232}],"title":"Trump presidency could scupper US World Cup bid: Gulati","seq_id":33453108,"is_hot":0,"site_url":"www.dailypioneer.com","source":"Pioneer","published_at":"2016-06-08 05:30:00","comments_count":null,"has_commented":false,"op_recommend":false,"source_url":"http:\/\/www.dailypioneer.com\/sports-bytes\/trump-presidency-could-scupper-us-world-cup-bid-gulati.html","type":"article","id":"5757ba01685a5f289ea0ca9b"},{"top_images":[{"origin":"http:\/\/image.newsdog.today\/origin_ccdf13fbc71cb85ed916144cb4bf4d48","source":"http:\/\/www.filmibeat.com\/img\/2016\/06\/ishaara-nair-controversy-08-1465366762.jpg","thumb_height":150,"thumb":"http:\/\/image.newsdog.today\/thumb_ccdf13fbc71cb85ed916144cb4bf4d48","thumb_width":200,"width":600,"height":450}],"related_images":[{"origin":"http:\/\/image.newsdog.today\/origin_ccdf13fbc71cb85ed916144cb4bf4d48","source":"http:\/\/www.filmibeat.com\/img\/2016\/06\/ishaara-nair-controversy-08-1465366762.jpg","thumb_height":150,"thumb":"http:\/\/image.newsdog.today\/thumb_ccdf13fbc71cb85ed916144cb4bf4d48","thumb_width":200,"width":600,"height":450}],"title":"SHOCKER: 'Sathuranga Vettai' Actress Ishaara Says She Was Subjected To Physical & Verbal Abuse","seq_id":33453179,"is_hot":0,"site_url":"www.filmibeat.com","source":"Filmi Beat","published_at":"2016-06-08 06:19:46","comments_count":null,"has_commented":false,"op_recommend":false,"source_url":"http:\/\/www.filmibeat.com\/tamil\/news\/2016\/sathuranga-vettai-ishaara-subjected-physical-verbal-abuse-controversy-229256.html","type":"article","id":"5757bbbf1290715d4d29a192"},{"top_images":[{"origin":"http:\/\/image.newsdog.today\/origin_19da2dc6182e9ce61df203ef9eaf2f3a","source":"http:\/\/i1.wp.com\/thewire.in\/wp-content\/uploads\/2016\/06\/download-18.jpeg?resize=450%2C299","thumb_height":133,"thumb":"http:\/\/image.newsdog.today\/thumb_19da2dc6182e9ce61df203ef9eaf2f3a","thumb_width":200,"width":450,"height":299}],"related_images":[{"origin":"http:\/\/image.newsdog.today\/origin_19da2dc6182e9ce61df203ef9eaf2f3a","source":"http:\/\/i1.wp.com\/thewire.in\/wp-content\/uploads\/2016\/06\/download-18.jpeg?resize=450%2C299","thumb_height":133,"thumb":"http:\/\/image.newsdog.today\/thumb_19da2dc6182e9ce61df203ef9eaf2f3a","thumb_width":200,"width":450,"height":299}],"title":"Malawi: Attacks on Albinos on the Rise, Body Parts Sold for Witchcraft, Says Amnesty","seq_id":33453204,"is_hot":0,"site_url":"thewire.in","source":"THE WIRE","published_at":"2016-06-08 06:17:20","comments_count":null,"has_commented":false,"op_recommend":false,"source_url":"http:\/\/thewire.in\/2016\/06\/08\/malawi-attacks-on-albinos-on-the-rise-body-parts-sold-for-witchcraft-says-amnesty-41530\/","type":"article","id":"5757bedc1290715d48391010"},{"top_images":[{"origin":"http:\/\/image.newsdog.today\/origin_f47d9d9d9afb1ddc196c03c05100524c","source":"http:\/\/mtvstat.in.com\/5f4251a19dc8391341642880ab858978_ls_xl.jpg","thumb_height":113,"thumb":"http:\/\/image.newsdog.today\/thumb_f47d9d9d9afb1ddc196c03c05100524c","thumb_width":200,"width":600,"height":338}],"related_images":[{"origin":"http:\/\/image.newsdog.today\/origin_f47d9d9d9afb1ddc196c03c05100524c","source":"http:\/\/mtvstat.in.com\/5f4251a19dc8391341642880ab858978_ls_xl.jpg","thumb_height":113,"thumb":"http:\/\/image.newsdog.today\/thumb_f47d9d9d9afb1ddc196c03c05100524c","thumb_width":200,"width":600,"height":338}],"title":"Adah Sharma looking forward to shoot with Esha Gupta for 'Commando 2'","seq_id":33453127,"is_hot":0,"site_url":"www.mtvindia.com","source":"MTV India","published_at":"2016-06-08 06:26:38","comments_count":null,"has_commented":false,"op_recommend":false,"source_url":"http:\/\/www.mtvindia.com\/blogs\/movies\/gossip\/adah-sharma-looking-forward-to-shoot-with-esha-gupta-for-commando-2-52198462.html","type":"article","id":"5757ba9e685a5f286fa0ce64"},{"top_images":[{"origin":"http:\/\/image.newsdog.today\/origin_06bcd4f2026e9241825d4652872221f1","source":"http:\/\/www.pinkvilla.com\/files\/styles\/contentpreview\/public\/KareenaAdShoot1.jpg?itok=cUIYU0hb","thumb_height":208,"thumb":"http:\/\/image.newsdog.today\/thumb_06bcd4f2026e9241825d4652872221f1","thumb_width":200,"width":572,"height":594}],"related_images":[{"origin":"http:\/\/image.newsdog.today\/origin_06bcd4f2026e9241825d4652872221f1","source":"http:\/\/www.pinkvilla.com\/files\/styles\/contentpreview\/public\/KareenaAdShoot1.jpg?itok=cUIYU0hb","thumb_height":208,"thumb":"http:\/\/image.newsdog.today\/thumb_06bcd4f2026e9241825d4652872221f1","thumb_width":200,"width":572,"height":594}],"title":"Kareena Kapoor Khan Stuns at an Ad Shoot!","seq_id":33453302,"is_hot":0,"site_url":"www.pinkvilla.com","source":"PINKVILLA","published_at":"2016-06-07 00:00:00","comments_count":null,"has_commented":false,"op_recommend":false,"source_url":"http:\/\/www.pinkvilla.com\/entertainment\/photos\/356054\/kareena-kapoor-khan-stuns-ad-shoot","type":"article","id":"5757c331685a5f2b540443fe"},{"top_images":[{"origin":"http:\/\/image.newsdog.today\/origin_a3541dcd6aeac080d628134372be117a","source":"http:\/\/media.ws.irib.ir\/image\/4bk6518eb507318g61_800C450.jpg","thumb_height":113,"thumb":"http:\/\/image.newsdog.today\/thumb_a3541dcd6aeac080d628134372be117a","thumb_width":200,"width":600,"height":338}],"related_images":[{"origin":"http:\/\/image.newsdog.today\/origin_a3541dcd6aeac080d628134372be117a","source":"http:\/\/media.ws.irib.ir\/image\/4bk6518eb507318g61_800C450.jpg","thumb_height":113,"thumb":"http:\/\/image.newsdog.today\/thumb_a3541dcd6aeac080d628134372be117a","thumb_width":200,"width":600,"height":338}],"title":"Iran raps terrorist bomb blast in Iraq\u2019s holy city of Karbala","seq_id":33453131,"is_hot":0,"site_url":"parstoday.com","source":"Parstoday","published_at":"2016-06-08 06:10:00","comments_count":null,"has_commented":false,"op_recommend":false,"source_url":"http:\/\/parstoday.com\/en\/news\/iran-i14713-iran_raps_terrorist_bomb_blast_in_iraq%E2%80%99s_holy_city_of_karbala","type":"article","id":"5757baaa685a5f2882a0cb70"},{"top_images":[{"origin":"http:\/\/image.newsdog.today\/origin_cf7c0015d4789c28c0f82b8cce91b2d3","source":"http:\/\/www.espncricinfo.com\/db\/PICTURES\/CMS\/227900\/227997.3.jpg","thumb_height":112,"thumb":"http:\/\/image.newsdog.today\/thumb_cf7c0015d4789c28c0f82b8cce91b2d3","thumb_width":200,"width":600,"height":337}],"related_images":[{"origin":"http:\/\/image.newsdog.today\/origin_cf7c0015d4789c28c0f82b8cce91b2d3","source":"http:\/\/www.espncricinfo.com\/db\/PICTURES\/CMS\/227900\/227997.3.jpg","thumb_height":112,"thumb":"http:\/\/image.newsdog.today\/thumb_cf7c0015d4789c28c0f82b8cce91b2d3","thumb_width":200,"width":600,"height":337}],"title":"South Africa agree to day-night Test - reports","seq_id":33453183,"is_hot":0,"site_url":"www.espncricinfo.com","source":"espn cric info","published_at":"2016-06-08 06:25:15","comments_count":null,"has_commented":false,"op_recommend":false,"source_url":"http:\/\/www.espncricinfo.com\/australia\/content\/story\/1023977.html","type":"article","id":"5757bc7e685a5f2b5a043fdc"}]}



## search接口

#### 请求地址: (post)

	http://newsapi.revanow.com/api/search

####请求格式 
	{"token":"","keyword":"hh","from":"0"}
	from参数非必带 eg:{"token":"","keyword":"hh"}

#### 返回格式

     {"code":200,"message":"OK","result_array":[{"top_images":[{"origin":"http:\/\/image.newsdog.today\/origin_e3a3793fc18b52d63d5d0a7a958d7abb","source":"http:\/\/outbreaknewstoday.com\/wp-content\/uploads\/2014\/11\/Rand-Paul.jpg","thumb_height":134,"thumb":"http:\/\/image.newsdog.today\/thumb_e3a3793fc18b52d63d5d0a7a958d7abb","thumb_width":200,"width":509,"height":341}],"related_images":[{"origin":"http:\/\/image.newsdog.today\/origin_e3a3793fc18b52d63d5d0a7a958d7abb","source":"http:\/\/outbreaknewstoday.com\/wp-content\/uploads\/2014\/11\/Rand-Paul.jpg","thumb_height":134,"thumb":"http:\/\/image.newsdog.today\/thumb_e3a3793fc18b52d63d5d0a7a958d7abb","thumb_width":200,"width":509,"height":341}],"title":["Rand Paul, bipartisan group of Senators call on <em>HHS<\/em> to follow Senate lead in increasing access to opioid addiction treatment"],"seq_id":33443537,"is_hot":1,"site_url":"outbreaknewstoday.com","source":"Outbreak News Today","published_at":"2016-06-06 11:14:25","comments_count":null,"has_commented":false,"op_recommend":false,"source_url":"http:\/\/outbreaknewstoday.com\/rand-paul-bipartisan-group-of-senators-call-on-hhs-to-follow-senate-lead-in-increasing-access-to-opioid-addiction-treatment-87506\/","type":"article","id":"57555b11129071795120eea1"}]}


## 推荐接口

#### 请求地址: (post)

	http://newsapi.revanow.com/api/articles

#### 请求格式 
	{"token":"","id":"","type":""}

#### 返回格式

	{"code":200,"message":"OK","result_array":[{"top_images":[{"origin":"http:\/\/www.thehealthsite.com\/news\/patients-on-dialysis-can-now-walk-with-wearable-artificial-kidney-ag0616\/data:image\/gif;base64,R0lGODdhAQABAPAAAP\/\/\/wAAACwAAAAAAQABAEACAkQBADs=","thumb_height":200,"thumb":"http:\/\/www.thehealthsite.com\/news\/patients-on-dialysis-can-now-walk-with-wearable-artificial-kidney-ag0616\/data:image\/gif;base64,R0lGODdhAQABAPAAAP\/\/\/wAAACwAAAAAAQABAEACAkQBADs=","thumb_width":300,"width":900,"height":600,"source":"http:\/\/www.thehealthsite.com\/news\/patients-on-dialysis-can-now-walk-with-wearable-artificial-kidney-ag0616\/data:image\/gif;base64,R0lGODdhAQABAPAAAP\/\/\/wAAACwAAAAAAQABAEACAkQBADs="}],"related_images":[{"origin":"http:\/\/www.thehealthsite.com\/news\/patients-on-dialysis-can-now-walk-with-wearable-artificial-kidney-ag0616\/data:image\/gif;base64,R0lGODdhAQABAPAAAP\/\/\/wAAACwAAAAAAQABAEACAkQBADs=","thumb_height":200,"thumb":"http:\/\/www.thehealthsite.com\/news\/patients-on-dialysis-can-now-walk-with-wearable-artificial-kidney-ag0616\/data:image\/gif;base64,R0lGODdhAQABAPAAAP\/\/\/wAAACwAAAAAAQABAEACAkQBADs=","thumb_width":300,"width":900,"height":600,"source":"http:\/\/www.thehealthsite.com\/news\/patients-on-dialysis-can-now-walk-with-wearable-artificial-kidney-ag0616\/data:image\/gif;base64,R0lGODdhAQABAPAAAP\/\/\/wAAACwAAAAAAQABAEACAkQBADs="}],"title":"Patients on dialysis can now walk with wearable artificial kidney","seq_id":33432059,"is_hot":0,"site_url":"www.thehealthsite.com","source":"The Health Site","published_at":"2016-06-03 14:43:57","comments_count":null,"has_commented":false,"op_recommend":false,"source_url":"http:\/\/www.thehealthsite.com\/news\/patients-on-dialysis-can-now-walk-with-wearable-artificial-kidney-ag0616\/","type":"article","id":"575197ad685a5f1d4c8db684"},{"top_images":[],"related_images":[],"title":"Diabetes drug metformin, a new weapon against cancer","seq_id":33433842,"is_hot":0,"site_url":"news.webindia123.com","source":"webindia123","published_at":"2016-06-04 00:00:00","comments_count":null,"has_commented":false,"op_recommend":false,"source_url":"http:\/\/news.webindia123.com\/news\/Articles\/Health\/20160604\/2875953.html","type":"article","id":"57525292685a5f474f8db9ba"},{"top_images":[],"related_images":[],"title":"Diabetes drug for cancer treatment & prevention","seq_id":33434158,"is_hot":0,"site_url":"news.webindia123.com","source":"webindia123","published_at":"2016-06-04 00:00:00","comments_count":null,"has_commented":false,"op_recommend":false,"source_url":"http:\/\/news.webindia123.com\/news\/Articles\/India\/20160604\/2875980.html","type":"article","id":"57526e67685a5f629d8dbc42"},{"top_images":[{"origin":"http:\/\/image.newsdog.today\/origin_34c6b7748eeeece02b5f1f97d655154f","source":"http:\/\/dc-cdn.s3-ap-southeast-1.amazonaws.com\/dc-Cover-1q33123v32b4pal7uma91efel2-20160604141153.Medi.jpeg","thumb_height":112,"thumb":"http:\/\/image.newsdog.today\/thumb_34c6b7748eeeece02b5f1f97d655154f","thumb_width":200,"width":600,"height":336}],"related_images":[{"origin":"http:\/\/image.newsdog.today\/origin_34c6b7748eeeece02b5f1f97d655154f","source":"http:\/\/dc-cdn.s3-ap-southeast-1.amazonaws.com\/dc-Cover-1q33123v32b4pal7uma91efel2-20160604141153.Medi.jpeg","thumb_height":112,"thumb":"http:\/\/image.newsdog.today\/thumb_34c6b7748eeeece02b5f1f97d655154f","thumb_width":200,"width":600,"height":336}],"title":"Diabetes drug may help some patients fight breast cancer","seq_id":33435229,"is_hot":0,"site_url":"www.deccanchronicle.com","source":"Deccan Chronicle","published_at":"2016-06-04 08:45:00","comments_count":null,"has_commented":false,"op_recommend":false,"source_url":"http:\/\/www.deccanchronicle.com\/lifestyle\/health-and-wellbeing\/040616\/diabetes-drug-may-help-some-patients-fight-breast-cancer.html","type":"article","id":"57529724685a5f75978db8a4"},{"top_images":[{"origin":"http:\/\/image.newsdog.today\/origin_04a6e8888643a2c7ad5e95b528d52782","source":"http:\/\/images.financialexpress.com\/2016\/05\/Blood-L-IE.jpg","thumb_height":133,"thumb":"http:\/\/image.newsdog.today\/thumb_04a6e8888643a2c7ad5e95b528d52782","thumb_width":200,"width":600,"height":400}],"related_images":[{"origin":"http:\/\/image.newsdog.today\/origin_04a6e8888643a2c7ad5e95b528d52782","source":"http:\/\/images.financialexpress.com\/2016\/05\/Blood-L-IE.jpg","thumb_height":133,"thumb":"http:\/\/image.newsdog.today\/thumb_04a6e8888643a2c7ad5e95b528d52782","thumb_width":200,"width":600,"height":400}],"title":"New blood test may help cancer treatment","seq_id":33436139,"is_hot":0,"site_url":"www.financialexpress.com","source":"Financial Express","published_at":"2016-06-04 13:11:46","comments_count":null,"has_commented":false,"op_recommend":false,"source_url":"http:\/\/www.financialexpress.com\/article\/lifestyle\/health\/new-blood-test-may-help-cancer-treatment\/273874\/","type":"article","id":"5752d61712907160ec6aee8b"},{"top_images":[{"origin":"http:\/\/image.newsdog.today\/origin_a1573aefb4ae883166ffc4dccd57a672","source":"http:\/\/bsmedia.business-standard.com\/_media\/bs\/img\/article\/2016-01\/12\/full\/1452543455-0924.jpg","thumb_height":150,"thumb":"http:\/\/image.newsdog.today\/thumb_a1573aefb4ae883166ffc4dccd57a672","thumb_width":200,"width":600,"height":449}],"related_images":[{"origin":"http:\/\/image.newsdog.today\/origin_a1573aefb4ae883166ffc4dccd57a672","source":"http:\/\/bsmedia.business-standard.com\/_media\/bs\/img\/article\/2016-01\/12\/full\/1452543455-0924.jpg","thumb_height":150,"thumb":"http:\/\/image.newsdog.today\/thumb_a1573aefb4ae883166ffc4dccd57a672","thumb_width":200,"width":600,"height":449}],"title":"AIIMS launches 'adopt a patient' policy","seq_id":33436354,"is_hot":0,"site_url":"www.business-standard.com","source":"Business Standard","published_at":"2016-06-04 00:00:00","comments_count":null,"has_commented":false,"op_recommend":false,"source_url":"http:\/\/www.business-standard.com\/article\/current-affairs\/aiims-launches-adopt-a-patient-policy-116060400670_1.html","type":"article","id":"5752e66c1290716e316aeba9"},{"top_images":[{"origin":"http:\/\/image.newsdog.today\/origin_4f89208c7a752830c97603b01787905d","source":"http:\/\/bsmedia.business-standard.com\/_media\/bs\/img\/article\/2016-01\/16\/full\/1452962877-1564.jpg","thumb_height":150,"thumb":"http:\/\/image.newsdog.today\/thumb_4f89208c7a752830c97603b01787905d","thumb_width":200,"width":600,"height":449}],"related_images":[{"origin":"http:\/\/image.newsdog.today\/origin_4f89208c7a752830c97603b01787905d","source":"http:\/\/bsmedia.business-standard.com\/_media\/bs\/img\/article\/2016-01\/16\/full\/1452962877-1564.jpg","thumb_height":150,"thumb":"http:\/\/image.newsdog.today\/thumb_4f89208c7a752830c97603b01787905d","thumb_width":200,"width":600,"height":449}],"title":"New drug may cure cancer","seq_id":33436550,"is_hot":0,"site_url":"www.business-standard.com","source":"Business Standard","published_at":"2016-06-04 00:00:00","comments_count":null,"has_commented":false,"op_recommend":false,"source_url":"http:\/\/www.business-standard.com\/article\/current-affairs\/new-drug-may-cure-cancer-116060400783_1.html","type":"article","id":"5752fb16685a5f17068dbd36"},{"top_images":[{"origin":"http:\/\/image.newsdog.today\/origin_9dcca8ef537b75cf926cf133d90d0721","source":"http:\/\/www.timesofoman.com\/uploads\/images\/2016\/06\/04\/426625.jpg","thumb_height":139,"thumb":"http:\/\/image.newsdog.today\/thumb_9dcca8ef537b75cf926cf133d90d0721","thumb_width":200,"width":600,"height":416}],"related_images":[{"origin":"http:\/\/image.newsdog.today\/origin_9dcca8ef537b75cf926cf133d90d0721","source":"http:\/\/www.timesofoman.com\/uploads\/images\/2016\/06\/04\/426625.jpg","thumb_height":139,"thumb":"http:\/\/image.newsdog.today\/thumb_9dcca8ef537b75cf926cf133d90d0721","thumb_width":200,"width":600,"height":416}],"title":"Witch doctors torture, rip off Omani patients","seq_id":33436837,"is_hot":0,"site_url":"timesofoman.com","source":"Times of Oman","published_at":"2016-06-04 16:16:00","comments_count":null,"has_commented":false,"op_recommend":false,"source_url":"http:\/\/timesofoman.com\/article\/85344\/Oman\/Health\/Omanis-suffering-from-mental-health-issues-are-putting-their-life-in-danger-by-visiting--ldquo;unpro","type":"article","id":"5753178512907102156af1bb"},{"top_images":[{"origin":"https:\/\/hugin.info\/134323\/I\/2017975\/104083.jpg","thumb_height":200,"thumb":"https:\/\/hugin.info\/134323\/I\/2017975\/104083.jpg","thumb_width":300,"width":900,"height":600,"source":"https:\/\/hugin.info\/134323\/I\/2017975\/104083.jpg"}],"related_images":[{"origin":"https:\/\/hugin.info\/134323\/I\/2017975\/104083.jpg","thumb_height":200,"thumb":"https:\/\/hugin.info\/134323\/I\/2017975\/104083.jpg","thumb_width":300,"width":900,"height":600,"source":"https:\/\/hugin.info\/134323\/I\/2017975\/104083.jpg"}],"title":"Novartis data show more than 50 percent of eligible Ph+ CML patients maintain Treatment-free Remission (TFR) after stopping Tasigna\u00ae","seq_id":33437608,"is_hot":0,"site_url":"andhranews.net","source":"Andhra News","published_at":"2016-06-05 03:26:29","comments_count":null,"has_commented":false,"op_recommend":false,"source_url":"http:\/\/andhranews.net\/Business\/2016\/Novartis-data-show-50-percent-eligible-22526.htm","type":"article","id":"57539be51290712456158b7b"},{"top_images":[{"origin":"http:\/\/image.newsdog.today\/origin_b841fe93999f96a559b85a59ab06b70c","source":"http:\/\/dc-cdn.s3-ap-southeast-1.amazonaws.com\/dc-Cover-herb24c029nvatfsbsgv9bg986-20160605131857.Medi.jpeg","thumb_height":112,"thumb":"http:\/\/image.newsdog.today\/thumb_b841fe93999f96a559b85a59ab06b70c","thumb_width":200,"width":600,"height":336}],"related_images":[{"origin":"http:\/\/image.newsdog.today\/origin_b841fe93999f96a559b85a59ab06b70c","source":"http:\/\/dc-cdn.s3-ap-southeast-1.amazonaws.com\/dc-Cover-herb24c029nvatfsbsgv9bg986-20160605131857.Medi.jpeg","thumb_height":112,"thumb":"http:\/\/image.newsdog.today\/thumb_b841fe93999f96a559b85a59ab06b70c","thumb_width":200,"width":600,"height":336}],"title":"Wearable artificial kidney may replace dialysis, shows new clinical trial","seq_id":33438674,"is_hot":0,"site_url":"www.deccanchronicle.com","source":"Deccan Chronicle","published_at":"2016-06-05 07:50:00","comments_count":null,"has_commented":false,"op_recommend":false,"source_url":"http:\/\/www.deccanchronicle.com\/lifestyle\/health-and-wellbeing\/050616\/wearable-artificial-kidney-may-replace-dialysis-shows-new-clinical-trial.html","type":"article","id":"5753dc4c12907156a86ae86b"}]}


##媒体列表接口

#### 请求地址: (post)

	http://newsapi.revanow.com/api/medias

#### 请求格式 
	{"token":"","read_tag":""}

#### 返回格式

     {"code":200,"message":"OK","result_array":[{"avatar":{"origin":"http:\/\/static.newsdog.today\/media\/indian-express.png","width":140,"height":140},"subscribed":true,"title":"Indian Express","desc":null,"id":"573c4639cdffbc7e992873e4","site_url":"indianexpress.com"},{"avatar":{"origin":"http:\/\/static.newsdog.today\/media\/business-today.png","width":140,"height":140},"subscribed":false,"title":"Business Today","desc":null,"id":"573c4639cdffbc7e9928744c","site_url":"www.businesstoday.in"},{"avatar":{"origin":"http:\/\/static.newsdog.today\/media\/india-today.png","width":140,"height":140},"subscribed":false,"title":"India Today","desc":null,"id":"573c4639cdffbc7e992873ff","site_url":"indiatoday.intoday.in"},{"avatar":{"origin":"http:\/\/static.newsdog.today\/media\/dna.png","width":140,"height":140},"subscribed":false,"title":"DNA","desc":null,"id":"573c4639cdffbc7e99287393","site_url":"www.dnaindia.com"},{"avatar":{"origin":"http:\/\/static.newsdog.today\/media\/new-indian-express.png","width":140,"height":140},"subscribed":false,"title":"New Indian Express","desc":null,"id":"573c4639cdffbc7e992874ce","site_url":"www.newindianexpress.com"},{"avatar":{"origin":"http:\/\/static.newsdog.today\/media\/financial-express.png","width":140,"height":140},"subscribed":false,"title":"Financial Express","desc":null,"id":"573c4639cdffbc7e992874bb","site_url":"www.financialexpress.com"},{"avatar":{"origin":"http:\/\/static.newsdog.today\/media\/bollywood-life.png","width":140,"height":140},"subscribed":false,"title":"Bollywood Life","desc":null,"id":"573c4639cdffbc7e992873d0","site_url":"www.bollywoodlife.com"},{"avatar":{"origin":"http:\/\/static.newsdog.today\/media\/firstpost.png","width":140,"height":140},"subscribed":false,"title":"Firstpost","desc":null,"id":"573c4639cdffbc7e99287395","site_url":"www.firstpost.com"},{"avatar":{"origin":"http:\/\/static.newsdog.today\/media\/webindia123.png","width":140,"height":140},"subscribed":false,"title":"webindia123","desc":null,"id":"573c4639cdffbc7e9928738b","site_url":"news.webindia123.com"},{"avatar":{"origin":"http:\/\/static.newsdog.today\/media\/oneindia.png","width":140,"height":140},"subscribed":false,"title":"oneindia","desc":null,"id":"573c4639cdffbc7e9928747e","site_url":"www.oneindia.com"},{"avatar":{"origin":"http:\/\/static.newsdog.today\/media\/free-press.png","width":140,"height":140},"subscribed":false,"title":"Free Press Journal","desc":null,"id":"573c4639cdffbc7e992874a2","site_url":"www.freepressjournal.in"},{"avatar":{"origin":"http:\/\/static.newsdog.today\/media\/new-kerala.png","width":140,"height":140},"subscribed":false,"title":"New Kerala","desc":null,"id":"573c4639cdffbc7e9928742c","site_url":"www.newkerala.com"},{"avatar":{"origin":"http:\/\/static.newsdog.today\/media\/reuters.png","width":140,"height":140},"subscribed":false,"title":"Reuters","desc":null,"id":"573c4639cdffbc7e992874ad","site_url":"in.reuters.com"},{"avatar":{"origin":"http:\/\/static.newsdog.today\/media\/sify.png","width":140,"height":140},"subscribed":false,"title":"Sify","desc":null,"id":"573c4639cdffbc7e992873a5","site_url":"www.sify.com"},{"avatar":{"origin":"http:\/\/static.newsdog.today\/media\/ibtimes-india.png","width":140,"height":140},"subscribed":false,"title":"IBTimes India","desc":null,"id":"573c4639cdffbc7e992874b5","site_url":"www.ibtimes.co.in"},{"avatar":{"origin":"http:\/\/static.newsdog.today\/media\/deccan-chronicle.png","width":140,"height":140},"subscribed":false,"title":"Deccan Chronicle","desc":null,"id":"573c4639cdffbc7e992874bf","site_url":"www.deccanchronicle.com"},{"avatar":{"origin":"http:\/\/static.newsdog.today\/media\/big-news-network.png","width":140,"height":140},"subscribed":false,"title":"Big News Network","desc":null,"id":"573c4639cdffbc7e992873b8","site_url":"www.bignewsnetwork.com"},{"avatar":{"origin":"http:\/\/static.newsdog.today\/media\/mid-day-mumbai.png","width":140,"height":140},"subscribed":false,"title":"Mid Day Mumbai","desc":null,"id":"573c4639cdffbc7e992873ce","site_url":"www.mid-day.com"},{"avatar":{"origin":"http:\/\/static.newsdog.today\/media\/deccan-herald.png","width":140,"height":140},"subscribed":false,"title":"Deccan Herald","desc":null,"id":"573c4639cdffbc7e992873d2","site_url":"www.deccanherald.com"},{"avatar":{"origin":"http:\/\/static.newsdog.today\/media\/forbes.png","width":140,"height":140},"subscribed":false,"title":"Forbes","desc":null,"id":"573c4639cdffbc7e99287481","site_url":"forbesindia.com"}]}

## 我的订阅列表

#### 请求地址: (post)

	http://newsapi.revanow.com/api/subscribe

#### 请求格式 
	{"token":""}

#### 返回格式

	{"code":200,"message":"OK","result_array":[{"avatar":{"origin":"http:\/\/static.newsdog.today\/media\/indian-express.png","width":140,"height":140},"subscribed":true,"title":"Indian Express","desc":null,"id":"573c4639cdffbc7e992873e4","site_url":"indianexpress.com"},{"avatar":{"origin":"http:\/\/static.newsdog.today\/media\/forbes.png","width":140,"height":140},"subscribed":true,"title":"Forbes","desc":null,"id":"573c4639cdffbc7e99287481","site_url":"forbesindia.com"}]}


## 主动订阅接口

#### 请求地址: (post)

	http://newsapi.revanow.com/api/putsubscribe

#### 请求格式 
	{"token":"","site_url":"forbesindia.com"}

#### 返回格式

     {"code":200,"message":"OK","result_object":{"status":"OK"}}

## 取消订阅接口

#### 请求地址: (post)

	http://newsapi.revanow.com/api/delsubscribe

#### 请求格式 
	{"token":"","site_url":"forbesindia.com"}

#### 返回格式 (待测试)

     {"code":200,"message":"OK","result_object":{"status":"OK"}}

## 点赞新闻接口

#### 请求地址: (post)

	http://newsapi.revanow.com/api/like

#### 请求格式 
	{"token":"","id":""}

#### 返回格式 
	{"code":200,"message":"OK","result_object":{"status":"OK"}}

## 取消点赞

#### 请求地址: (post)

	http://newsapi.revanow.com/api/unlike

#### 请求格式 
	{"token":"","id":""}

#### 返回格式 
	{"code":200,"message":"OK","result_object":{"status":"OK"}}


## 已下架source

     https://docs.google.com/spreadsheets/d/1exZREoPWuAKNnU7OvfIA1V13fyrDXTVhxcW3QtRX1Y8/edit?usp=sharing

## 城市列表（get）

    http://newsapi.revanow.com/api/city

## 文章反馈

####请求地址 （post）

    http://newsapi.revanow.com/api/feedback

#### 请求格式 
	{"token":"","id":"","reason":""}

## 获取媒体下的新闻列表

     http://newsapi.revanow.com/api/medialist

#### 请求格式 
	{"token":"","id":""}


## 返回码
    400 参数错误 {"code":400,"message":"param is invalid","result_array":null}
    404 请求资源不存在，message信息根据newsdog接口返回为准  {"code":404,"message":"param is invalid","result_array":null}


## log地址
	http://log.newsdog.today/v1/lewa/logs/