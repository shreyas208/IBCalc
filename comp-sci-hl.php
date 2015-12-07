<?php
$subject = "IB Computer Science";
$subtitle = "Higher Level";
$note = "Based on <a href=\"img/M14-HL-COMPSCI-boundaries.png\" target=\"_blank\">May 2014 grade boundaries</a>";
$boundaries = "13, 27, 36, 45, 54, 63, 100";
$comps = [
    0 => [
        "id" => 'p1',
        "name" => "Paper 1",
        "weight" => 40,
        "max_marks" => 100
    ],
    1 => [
        "id" => 'p2',
        "name" => "Paper 2",
        "weight" => 20,
        "max_marks" => 65
    ],
    2 => [
        "id" => 'p3',
        "name" => "Paper 3",
        "weight" => 20,
        "max_marks" => 30
    ],
    3 => [
        "id" => 'ia',
        "name" => "IA Product",
        "weight" => 17,
        "max_marks" => 34
    ],
    4 => [
        "id" => 'g4',
        "name" => "Group 4",
        "weight" => 3,
        "max_marks" => 6
    ]
]
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>IB Grade Calculator</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<style type="text/css">
    label {
        font-size: 1.2em;
    }
</style>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1><?php echo $subject ?></h1>
            <h3><?php echo $subtitle ?></h3>
            <h4><?php echo $note ?></h4>
        </div>
        <br>
<?php
foreach ($comps as $comp) {
    echo "\t\t<div class=\"col-lg-3 col-md-3 col-sm-6\">\n\t\t\t<h2>".$comp['name']."</h2>\n\t\t\t<h3>".$comp['weight']."%, ".$comp['max_marks']." marks</h3>";
    echo "\n\t\t\t<label for=\"".$comp['id']."marks\">Marks: </label>";
    echo "\n\t\t\t<select id=\"".$comp['id']."marks\" onchange=\"update()\">";
    for ($j = $comp[max_marks] ; $j >= 0 ; $j--) {
        echo "\n\t\t\t\t<option value=\"".$j."\">".$j."</option>";
    }
    echo "\n\t\t\t</select>";
    echo "\n\t\t\t<input id=\"".$comp['id']."weight\" type=\"hidden\" value=\"".$comp['weight']."\">";
    echo "\n\t\t\t<input id=\"".$comp['id']."max\" type=\"hidden\" value=\"".$comp['max_marks']."\">\n\t\t</div>\n";
}
?>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6">
            <h2>IB Marks: <span id="ibmarks"></span></h2>
            <h2>IB Grade: <span id="ibgrade"></span></h2>
        </div>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script type="application/javascript">
    var boundaries = [<?php echo $boundaries ?>];
    var ids = [<?php foreach ($comps as $comp) {echo '"'.$comp['id'].'", ';} ?> ""];
    function update() {
        var totalMarks = 0;
        for (var i = 0 ; i < ids.length-1 ; i++ ) {
            totalMarks += document.getElementById(ids[i] + 'marks').value / (document.getElementById(ids[i] + 'max').value / document.getElementById(ids[i] + 'weight').value);
        }
        totalMarks = Math.round(totalMarks);
        document.getElementById('ibmarks').innerHTML = totalMarks;
        for (var j = 0 ; j < 7 ; j++) {
            if (totalMarks < boundaries[j]) {
                document.getElementById('ibgrade').innerHTML = (j + 1) + '';
                break;
            }
        }
    }
</script>
</body>
</html>