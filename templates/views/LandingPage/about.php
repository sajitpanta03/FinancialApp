<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<title>Website About Us Page HTML CSS</title>
</head>

<body>
	<section class="about-us">
		<div class="about">
			<img src="assets/photos/bg-form-goal.jpg" class="pic" />
			<div class="text">
				<h2>About Us</h2>
				<h5>Front-end Developer & <span>Designer</span></h5>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita natus ad sed harum itaque ullam enim quas, veniam accusantium, quia animi id eos adipisci iusto molestias asperiores explicabo cum vero atque amet corporis! Soluta illum facere consequuntur magni. Ullam dolorem repudiandae cumque voluptate consequatur consectetur, eos provident necessitatibus reiciendis corrupti!</p>
				<div class="data">
					<a href="#" class="hire">Hire Me</a>
				</div>
			</div>
		</div>
	</section>
</body>

</html>

<style>
	@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&display=swap");

	* {
		margin: 0;
		padding: 0;
		box-sizing: border-box;
		font-family: "Poppins", sans-serif;
		background: wheat;
	}

	.about-us {
		display: flex;
		align-items: center;
		height: 100vh;
		width: 100%;
		padding: 90px 0;

	}

	.pic {
		height: auto;
		width: 400px;
		border-radius: 12px;
	}

	.about {
		width: 1130px;
		max-width: 85%;
		margin: 0 auto;
		display: flex;
		align-items: center;
		justify-content: space-around;
	}

	.text {
		width: 540px;
	}

	.text h2 {
		color: #333;
		font-size: 90px;
		font-weight: 600;
		margin-bottom: 10px;
	}

	.text h5 {
		color: #333;
		font-size: 22px;
		font-weight: 500;
		margin-bottom: 20px;
	}

	span {
		color: #4070f4;
	}

	.text p {
		color: #333;
		font-size: 18px;
		line-height: 25px;
		letter-spacing: 1px;
	}

	.data {
		margin-top: 30px;
	}

	.hire {
		font-size: 18px;
		background: #4070f4;
		color: #fff;
		text-decoration: none;
		border: none;
		padding: 12px 25px;
		border-radius: 6px;
		transition: 0.5s;
	}

	.hire:hover {
		background: #000;
	}
</style>