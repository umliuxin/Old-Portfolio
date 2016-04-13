<?php
require_once("facebook.php");

$config = array();
$config['appId'] = '1424582031092598';
$config['secret'] = '1a82f88f536f41e69fb6231fd1caf2b4';
$config['fileUpload'] = false; // optional

$facebook = new Facebook($config);

// Get user info
$uid = $facebook->getUser();//获取用户id  是一个string

// Log in url
$params = array(
  'scope' => 'read_stream, friends_likes,friends_location,friends_checkins');
$loginUrl = $facebook->getLoginUrl($params);//没登陆的话登陆的 是一个string

// Log out url
//$params = array( 'next' => 'https://www.myapp.com/after_logout' );
$logoutUrl = $facebook->getLogoutUrl(); //登出facebook

// Test API call: get all your friends
if ($uid != 0) {
	$result = $facebook->api('/' . $uid . '?fields=friends.fields(location,name,picture,checkins)');
}

        $checkinresult=array();
        $userresult=array();
        
            
		if (!empty($result)) {
			$data = $result['friends']['data'];
			//echo "$data is";
			//print_r($data);
			
			for ($i=0; $i<count($data); $i++) {
			    
                
                 
                 
                //console.log(count($data[$i]['checkins']['data']));
                //console.log(array_key_exists("checkins",$data[$i]));
                
                //if(count($data[$i]['checkins']['data'])!=0) {
                if (array_key_exists("checkins",$data[$i])) {
                        for ($j=0; $j<count($data[$i]['checkins']['data']); $j++) {
                        //for ($j=0; $j<3; $j++) {
                            $checkinname=$data[$i]['checkins']['data'][$j]['place']['name'];
                            $checkincity=$data[$i]['checkins']['data'][$j]['place']['location']['city'];
                            $checkinstate=$data[$i]['checkins']['data'][$j]['place']['location']['state'];
                            $checkinlat=$data[$i]['checkins']['data'][$j]['place']['location']['latitude'];
                            $checkinlng=$data[$i]['checkins']['data'][$j]['place']['location']['longitude'];
                            $checkintime=$data[$i]['checkins']['data'][$j]['created_time'];
                            
                            
                            array_push($checkinresult,array($checkinname,$checkincity,$checkinstate,$checkinlat,$checkinlng,$checkintime));
                            array_push($userresult,array($data[$i]['name'],$checkinresult));
                            
                        }
                     }
                 
                 
			     }	
			 
			     

		}
		//print_r($locationresult);
		echo "checkinresult is";
		print_r($checkinresult[1]);
		echo "data[1] is";
		print_r($data[1]);
		//var_dump($userresult);	
		//print_r($userresult);
		// for ($j=0; $j<count($userresult); $j++){
// 		    echo "<p>aaa".$userresult[$j]."</p>";
// 		}
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>SI 649 Final Project</title>
		
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
        <script type="text/javascript" src="gmaps.js"></script>
        
        <link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.3.0/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="examples.css" />
        
        <!-- start using google map -->
        <script type="text/javascript">
            $(function start() {
            function abso() {
                    $('#map').css({
                        position: 'absolute',
                        
                        width: $(window).width()-220,
                        height: $(window).height()-120
            
                    });    
            
                }
            
                $(window).resize(function() {
                    abso();
                });
            
                abso();
                
                
            
            });
        
    
            
            // ready()
            var map;  
            $(document).ready(function(){
              map = new GMaps({
                el: '#map',
                lat: 38.9581,
                lng: -95.2478,
                zoom:4
              });
              
			 
            //allow javascript to retrieve php's array.

			var jscheckinresult=<?php echo json_encode($checkinresult);?>;
       	 	console.log(jscheckinresult);
            //alert(jscheckinresult.length);
            
            
            
            map.addMarker({
                    lat: 38,
                    lng: -95,
                    title: 'Marker with InfoWindow',
                    icon: 'marker-02.png',
                    infoWindow: {content: 'Overall Ranking'}
                    
                });  
                
           
                
                
                for (var i = 0; i < 100; i++) {  
                  //add markers 
                  map.addMarker({
                    
                    lat: jscheckinresult[i][3],
                    lng: jscheckinresult[i][4],
                    title: 'Marker with InfoWindow',
                    icon: 'marker-02.png',
                    infoWindow: {content: 'Overall Ranking'}
                  });
                  
                  }
               
            
         
            });  //end of ready()
            
            
         
          
          </script>
		
	</head>
	<body>
		<p><?= $uid ?></p>
		<p><a href="<?= $loginUrl ?>">Login</a></p>
		<p><a href="<?= $logoutUrl ?>">Logout</a></p>
		<div id="map"></div>
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	
	<?php
	
	
        
        
        
		
		?>
		
		

	</body>
</html>