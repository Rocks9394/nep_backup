<?PHP
$data = DB::table('activity')
				->leftJoin('activity_class', 'activity_class.act_id', '=', 'activity.id')			
				->leftJoin('class','class.id', '=', 'activity_class.class_id')
				->select(['activity.id','activity.id as actid','activity.teach_id','activity.title','activity.image','activity.description','activity_class.act_id','class.id','class.name as clsname','activity.status']);
						   
			if($request->classSelect2){
				
			   $data = $data->whereIn('activity_class.class_id', $cats);
			}	




$professionals = DB::table('activity')
    ->select(activity.id','activity.id as actid','activity.teach_id','activity.title','activity.image','activity.description','activity_class.act_id','class.id','class.name as clsname','activity.status', DB::raw("(GROUP_CONCAT(DISTINCT p.picture_path SEPARATOR ',')) as 'photos'"))
    ->leftjoin('activity_class','activity_class.act_id','=','activity.id')
    ->leftjoin('class','m.city','=','locations.location_id');

if ($professionals_type != '') {
    $professionals = $professionals->where('mp.biz_category','=',$professionals_type);
}

if ($location != '') {
    $professionals = $professionals->where('m.city','=',$location);
}
$professionals = $professionals->where('m.member_type','=',2)
    ->groupBy('mp.id', 'mp.title',  'mp.col2',  'mp.col3')
    ->paginate(20);







#########################################################################################

SELECT DISTINCT
p1.post_title as title, p1.post_content as content, p2.guid as image

,(SELECT group_concat(wp_terms.name separator ', ') 
    FROM wp_terms
    INNER JOIN wp_term_taxonomy on wp_terms.term_id = wp_term_taxonomy.term_id
    INNER JOIN wp_term_relationships wpr on wpr.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id
    WHERE taxonomy= 'category' and p1.ID = wpr.object_id
) AS "category"


,(SELECT group_concat(wp_terms.name separator ', ') 
    FROM wp_terms
    INNER JOIN wp_term_taxonomy on wp_terms.term_id = wp_term_taxonomy.term_id
    INNER JOIN wp_term_relationships wpr on wpr.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id
    WHERE taxonomy= 'age' and p1.ID = wpr.object_id
) AS "class"


,(SELECT group_concat(wp_terms.name separator ', ') 
    FROM wp_terms
    INNER JOIN wp_term_taxonomy on wp_terms.term_id = wp_term_taxonomy.term_id
    INNER JOIN wp_term_relationships wpr on wpr.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id
    WHERE taxonomy= 'skill' and p1.ID = wpr.object_id
) AS "skills"

FROM wp_posts as p1 

LEFT JOIN wp_posts p2  ON p1.ID = p2.post_parent AND p2.post_type='attachment'

WHERE p1.post_type = 'post'  
GROUP BY title
, content

ORDER BY
title
, content
?>
php artisan cache:clear
php artisan config:cache
php artisan config:clear
php artisan route:cache
php artisan route:clear

#######################25-03-2021##############################################
https://md-in-51.webhostbox.net:2083/
conve3mw
Linux@2017#

fitness365.me/wp-login.php
ctadmin
Convergent@#2019$fit
https://fitness365.me/wp-admin/edit.php
https://fitness365.me/activities/actovities

SELECT DISTINCT
post_title
, post_content
,(SELECT group_concat(wp_terms.name separator ', ') 
    FROM wp_terms
    INNER JOIN wp_term_taxonomy on wp_terms.term_id = wp_term_taxonomy.term_id
    INNER JOIN wp_term_relationships wpr on wpr.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id
    WHERE taxonomy IN ("category","age","skill")  and wp_posts.ID = wpr.object_id
) AS "Categories" FROM wp_posts
WHERE post_type = 'post' 
ORDER BY
post_title
, post_content


#######################09-03-2021##############################################

https://www.laravelcode.com/post/how-to-make-admin-auth-in-laravel8-with-example

#######################09-03-2021##############################################

####################Fitindia Cisco Password###############################

Fitimdia@123

################################103 admin password##########################################
 sandy@gmail.com/password
 
 ################################87 admin password##########################################
 
 dwl
 nativeuser/Fitindia@12345
 
##########################################################################

10.247.140.87
admin
password:- Myas1234!@#^%M

####################forget password###############################

https://www.youtube.com/watch?v=0Ff1vZdWlb0

 brij.kishore@seqfast.com
############################################

https://www.sportaus.gov.au/p4l
https://goforfit.in/video/kids-learning-through-play-gross-motro-skill-preschool-kids/
https://fitindia.gov.in/beta/fit-india-champions

############################Send Mail#####################################

https://www.youtube.com/watch?v=CK9hVbEJVvY

############################server(INDIA ASSIST)#####################################

php artisan make:provider SmsServiceProvider
ubuntu
cd /var/www/html/edutok
sudo chmod 777 /var/www/html
sudo chmod 755 /var/www/html
composer require sendinblue/api-v3-sdk "7.x.x"

############################SMS#####################################

https://hotexamples.com/examples/-/Mailin/send_sms/php-mailin-send_sms-method-examples.html

#################################################################

https://github.com/sendinblue/APIv3-php-library

https://help.sendinblue.com/hc/en-us/categories/201054225-Integrations-API

https://developers.sendinblue.com/docs/api-clients

#################################################################

https://developers.sendinblue.com/docs/api-clients
nagendra.kumar@seqfast.com/Password@2k
webmail.liveplus.in

#################################################################

13.127.214.23
ubuntu

#################################################################

composer require juanparati/sendinblue "^8.0"
https://github.com/juanparati/Sendinblue

###############Zoommetting##################################################

forget pasword/emailverification jwt 
api/ui/

Hello sir,
Please join zoom meeting everyday at office time 
Join Zoom Meeting

https://us04web.zoom.us/j/5109381486?pwd=amJjSHJvYitXK1E3aG9rNmJWRHROZz09
 
Meeting ID: 510 938 1486
Passcode: 162546


#################################################################

no-reply@seqfast.com

Password@2k
---------------------------
sftp details:

cd /var/www/html/edutok
---------------------------
103.65.20.170 - ip
username - sequonia
password - P@55w0rd!!!!

Database & PHPMyAdmin Details
---------------------------------------
http://103.65.20.170/phpmyadmin

username - root
password - CT@#2019$smf    
  
select table.field COLLATE utf8mb4_0900_ai_ci AS fieldName  
  
ALTER TABLE categories CONVERT TO CHARACTER SET utf8 COLLATE                     

#######################################

//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

https://getcodify.com/integrating-send-blue-transactional-email-using-php/

https://account.sendinblue.com/advanced/api

https://www.itsolutionstuff.com/post/how-to-send-mail-using-sendinblue-in-laravelexample.html

email=>nagendragupta85@gmail.com
VERSION =>v3
API KEY	=>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
SMTP Serversmtp-relay.sendinblue.com
Port587
Login =>nagendragupta85@gmail.com	
Master password	=>vkmYOarJFgNWBXsS

sendin view

API INTRIGATE KARTE HAI LARAVEL KE SATH

https://developers.sendinblue.com/docs/send-a-transactional-email

https://learninglaravel.net/learn-how-to-send-emails-for-free-using-sendinblue-in-laravel-5

harshit.mahajan@seqfast.com
arun.kumar@seqfast.com
devendra.tadiyal@seqfast.com
arun.kumar@seqfast.com
sandeep.singh@seqfast.com