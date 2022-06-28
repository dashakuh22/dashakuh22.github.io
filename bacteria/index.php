<?php

$count_red = '';
$count_green = '';
$count_rounds = '';

$produced_count_red = '';
$produced_count_green = '';

$error = "";

if($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['count-red']) && isset($_POST['count-green']) && isset($_POST['count-rounds'])) {

        $count_red = $_POST['count-red'];
        $count_green = $_POST['count-green'];
        $count_rounds = $_POST['count-rounds'];

        $a = gmp_init($count_red);
        $b = gmp_init($count_green);
        $i = gmp_init($count_rounds);

        $first_sub = gmp_mul(gmp_sub(gmp_mul($a, 3), gmp_mul($b, 2)), gmp_pow(2, gmp_intval($i)));
        $second_sub = gmp_mul(gmp_mul(gmp_add($a, $b), gmp_pow(7, gmp_intval($i))), gmp_init(2));

        $produced_count_red = gmp_div(gmp_add($first_sub, $second_sub), 5);
        $produced_count_red = gmp_intval($produced_count_red);

        $first_sub = gmp_mul(gmp_sub(gmp_mul($b, 2), gmp_mul($a, 3)), gmp_pow(2, gmp_intval($i)));
        $second_sub = gmp_mul(gmp_mul(gmp_add($a, $b), gmp_pow(7, gmp_intval($i))), gmp_init(3));

        $produced_count_green = gmp_div(gmp_add($first_sub, $second_sub), 5);
        $produced_count_green = gmp_intval($produced_count_green);

    } else $error = "Fill in all the fields!";
}
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body style="background-color: #2f0b45">
<input type="checkbox" id="nav-toggle" hidden>
<nav class="nav">
    <label for="nav-toggle" class="nav-toggle" onclick></label>
    <h2>
        INFO
    </h2>
    <ul>
        <li>1 <span class="red">red</span> bacteria produces<br>
            3 <span class="red">red</span> and 4 <span class="green">green</span>
        </li>
        <li>1 <span class="green">green</span> bacteria produces<br>
            2 <span class="red">red</span> and 5 <span class="green">green</span>
        </li>
    </ul>
</nav>
<div class="container">
    <div class="row">
        <div class="<?= ($_SERVER["REQUEST_METHOD"] === "GET") ? "col-md-12" : "col-md-6"?> centered">
            <div class="tab" role="tabpanel">
                <div class="title-form">
                    <label>Choose parameters</label>
                </div>
                <div class="tab-content tabs">
                    <div role="tabpanel" class="tab-pane fade in active" id="Section1">
                        <form class="form-horizontal" method="POST">
                            <div class="form-group">
                                <label>Count of red bacteria</label>
                                <input type="number" min="0" class="form-control" name="count-red" required
                                       value="<?= isset($_POST['count-red']) ? $_POST['count-red'] : '' ?>">
                            </div>
                            <div class="form-group">
                                <label>Count of green bacteria</label>
                                <input type="number" min="0" class="form-control" name="count-green" required
                                       value="<?= isset($_POST['count-green']) ? $_POST['count-green'] : '' ?>">
                            </div>
                            <div class="form-group">
                                <label>Count of rounds</label>
                                <input type="number" min="0" class="form-control" name="count-rounds" required
                                       value="<?= isset($_POST['count-rounds']) ? $_POST['count-rounds'] : '' ?>">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.col-md-offset-3 col-md-6 -->
        <div class="col-md-6 centered"<?= ($_SERVER["REQUEST_METHOD"] === "GET") ? 'hidden' : '' ?> >
            <div class="tab" role="tabpanel">
                <div class="tab-content tabs">
                    <div class="title-form">
                        <label>Your result</label>
                    </div>
                    <div role="tabpanel" class="tab-pane fade in active" id="Section1">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label>Count of red bacteria</label>
                                <input disabled class="form-control form-control-res" value="<?php echo $produced_count_red?>">
                            </div>
                            <div class="form-group">
                                <label>Count of green bacteria</label>
                                <input disabled class="form-control form-control-res" value="<?php echo $produced_count_green?>">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div>
                <img src="css/bacteria.png" alt="bacteria" height="200px" width="200px" align="center">
            </div>
        </div><!-- /.col-md-offset-3 col-md-6 -->
    </div><!-- /.row -->
</div><!-- /.container -->
</body>
</html>
