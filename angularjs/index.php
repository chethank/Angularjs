<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<title>Sample code</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="css/main.css" />
		<script type="text/javascript" src="js/jquery.js"></script>
	</head>
	<body>
		<!-- @start Main Wrapper -->
		<div id="wrapper">

			<!-- @start Header -->
			<div id="header">
				<h1>
					Sample user list
				</h1>
			</div>
			<!-- @end Header -->


			<!-- @start Content -->
			<div id="content">
				<ol id="users_list">
					<li><a href=javascript:void(0)>Jack</a></li>
					<li><a href=javascript:void(0)>Harry</a></li>
					<li><a href=javascript:void(0)>Jim</a></li>
					<li><a href=javascript:void(0)>Jasmin</a></li>
					<li><a href=javascript:void(0)>Jonny</a></li>
					<li><a href=javascript:void(0)>Albin</a></li>
					<li><a href=javascript:void(0)>Antony</a></li>
				</ol>

				<div id="overlay_form" style="display:none">
					<div class="option">
						<span>Change date format to:</span> 
						<select id="change_date">
							<option value="dd">dd/mm/yyyy</option>
							<option value="mm">mm/dd/yyyy</option>
						</select>
					</div>	
					<table>
						<thead>
							<tr>
								<th>User</th>
								<th>Last login details</th>
								<th># times logged in</th>
							</tr>
						</thead>
						<tbody>
							<tr><td>Jim</td><td>20/01/2013</td><td>20</td></tr>							
						</tbody>
					</table>
					<div class="close">
						<a href="javascript:void(0)" id="close">Close</a>
					</div>	
				</div>
			</div>
			<!-- @end Content -->
			
		</div>
		<!-- @end Main Wrapper -->
		
		<script type="text/javascript">
		var login_date = '';
		$(function(){
			//open popup
			$("#users_list li a").click(function(){
			  positionPopup($(this));
			});

			//close popup
			$("#close").click(function(){
				$("#overlay_form").fadeOut(500);
			});
			
			//change date format
			$("#change_date").change(function(){
				changeDateFormat($(this).val());
			});
		});
	
		//position the popup at the center of the page
		function positionPopup(det){
			$('#overlay_form table').find('tbody td').remove();
		  	var url = 'users.php';
		  	var data = "user_name="+det.html();
		  	$.post(url,data,function(resp){
				console.log(resp);
				login_date = resp.last_login;
				if(resp) {
					var html = '<td>'+det.html()+'</td><td>'+resp.last_login+'</td><td>'+resp.login_times+'</td>';
					$('#overlay_form table').find('tbody tr').append(html);
				} else {
					var html = '<td>'+det.html()+'</td><td>No data</td><td>No data</td>';
					$('#overlay_form table').find('tbody tr').append(html);
				}
			}, "json");
			$("#overlay_form").fadeIn(1000);
			$("#overlay_form").css({
				left: ($(window).width() - $('#overlay_form').width()) / 2,
				top: ($(window).width() - $('#overlay_form').width()) / 7,
				position:'absolute'
			});
		}
		
		function changeDateFormat(format){
			var dateString = login_date;
			var reg_exp = /(\d{2})\/(\d{2})\/(\d{4})/;
			var dateArray = reg_exp.exec(dateString); 
			var new_date = '';
			
			if(format == 'mm'){
				new_date = dateArray[2]+'/'+dateArray[1]+'/'+dateArray[3];
			} else if (format == 'dd') {
				new_date = dateArray[1]+'/'+dateArray[2]+'/'+dateArray[3];
			}
			$('#overlay_form table').find('tbody tr td:eq(1)').html(new_date);
		}

		//maintain the popup at center of the page when browser resized
		$(window).bind('resize',positionPopup);

		</script>
	</body>
</html>		