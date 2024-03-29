<?php
	include_once './config.php';
	include_once './db/db_config.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		
		<title><?=$sys['name']?></title>
		
		<link rel="stylesheet" type="text/css" href="./css/member_form.css?var=<?=$sys['var']?>">
		<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css?var=<?=$sys['var']?>">
		<link rel="stylesheet" type="text/css" href="./css/all.css?var=<?=$sys['var']?>">
		
		<script src="./js/jquery-1.10.2.js?var=<?=$sys['var']?>"></script>
		<script src="./js/jquery.slim.min.js?var=<?=$sys['var']?>"></script>
		<script src="./js/bootstrap.bundle.min.js?var=<?=$sys['var']?>"></script>
	
		<script>
			$(function(){
				$("#id").blur(function(){
					if($(this).val() != ""){
						idCheck();
					}
				});
			});
		
			function idCheck(){
				$.ajax({
					url:"./ajax/check_id.php",
					type:"post",
					dataType:"json",
					data:{"id":$("#id").val()},
					success:function(data){
						if(data.check){
							$("#idcheck").attr("value", "1");
							alert('사용 가능한 아이디입니다!');
						}
						else{
							$("#idcheck").attr("value", "0");
							alert('중복된 아이디입니다. 다른 아이디를 입력해 주세요!');
						}
					}
				});
			}

			$(function(){
				$("#nickname").blur(function(){
					if($(this).val() != ""){
						nicknameCheck();
					}
				});
			});

			function nicknameCheck(){
				$.ajax({
					url:"./ajax/check_nickname.php",
					type:"post",
					dataType:"json",
					data:{"nickname":$("#nickname").val()},
					success:function(data){
						if(data.check){
							$("#nicknamecheck").attr("value", "1");
							alert('사용 가능한 닉네임 입니다!');
						}
						else{
							$("#nicknamecheck").attr("value", "0");
							alert('중복된 닉네임입니다. 다른 닉네임을 입력해 주세요!');
						}
					}
				});
			}
		
			$(function(){
				$("#save").click(function(){
					check_input();
				});
			});

			function check_input(){
				if(!$("#name").val()){
					alert("이름을 입력하세요!");
					$("#name").focus();
					return;
				}

				if(!$("#nickname").val()){
					alert("닉네임을 입력하세요!");
					$("#nickname").focus();
					return;
				}

				if($("#nicknamecheck").val() == 0){
					alert("중복된 닉네임을 입력하셨습니다. 다른 닉네임을 입력해 주세요!");
					return;
				}

				if(!$("#email").val()){
					alert("이메일을 입력하세요!");
					$("#email").focus();
					return;
				}

				if(!$("#id").val()){
					alert("아이디를 입력하세요!");
					$("#id").focus();
					return;
				}

				if($("#idcheck").val() == 0){
					alert("중복된 아이디를 입력하셨습니다. 다른 아이디를 입력해 주세요!");
					return;
				}

				if(!$("#pass").val()){
					alert("비밀번호를 입력하세요!");
					$("#pass").focus();
					return;
				}

				if(!$("#pass_confirm").val()){
					alert("비밀번호 확인을 입력하세요!");
					$("#pass_confirm").focus();
					return;
				}

				if($("#pass").val() !=
					$("#pass_confirm").val()){
						alert("비밀번호가 일치하지 않습니다.\n다시 입력해 주세요!");
						$("#pass").focus();
						$("#pass").select();
						return;
				}
				
				$("#member_form").submit();
			}
		</script>
	</head>
	
	<body>
		<header>
    		<?php include_once "header.php";?>
		</header>
		<br/><br/>
		
		<div class="container">
    		<div class="row">
      			<div class="col-lg-10 col-xl-9 mx-auto">
        			<div class="card card-signin flex-row my-5">
        				<div class="card-img-left d-none d-md-flex"></div>

				        <div class="card-body">
				        	<h5 class="card-title text-center">Sign Up</h5>
				            <form class="form-signin" name="member_form" id="member_form" method="post" action="member_insert.php">
				             <div class="form-label-group">
				                <input type="text" id="name" name="name" class="form-control" placeholder="이름">
				                <label for="name">이름</label>
				             </div>
				             
				             <div class="form-label-group">
				                <input type="text" id="nickname" name="nickname" class="form-control" placeholder="닉네임">
				                <label for="nickname">닉네임</label>
				                <input type="hidden" id="nicknamecheck" name="nicknamecheck" value="0">
				             </div>
							
				             <div class="form-label-group">
				                <input type="email" id="email" name="email" class="form-control" placeholder="이메일">
				                <label for="email">이메일 (ex. @gachon.ac.kr @gc.gachon.ac.kr)</label>
				             </div>
				             
				             <hr>
				
				             <div class="form-label-group">
				                <input type="text" id="id" name="id" class="form-control" placeholder="아이디">
				                <label for="id">아이디</label>
				                <input type="hidden" id="idcheck" name="idcheck" value="0">
				             </div>
				             
				             <div class="form-label-group">
				                <input type="password" id="pass" name="pass" class="form-control" placeholder="비밀번호">
				                <label for="pass">비밀번호</label>
				             </div>
				              
				             <div class="form-label-group">
				                <input type="password" id="pass_confirm" name="pass_confirm" class="form-control" placeholder="비밀번호 확인">
				                <label for="pass_confirm">비밀번호 확인</label>
				             </div>
								
							 <br/>
				             <button class="btn btn-lg btn-primary btn-block text-uppercase" type="button" id="save" onclick="check_input()">Sign up</button>
				          	</form>
				        </div>
					</div>
				</div>
    		</div>
		</div>

		<footer>
		<?php include_once 'footer.php';?>
		</footer>
</body>
</html>