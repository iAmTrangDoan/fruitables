<h2>5.1</h2>
<?php  
    $a=9;
    $b=2;
    $phannguyen=intdiv($a,$b);
    $phandu=$a%$b;
    echo "Phan nguyen a/b=$phannguyen<br>";
    echo "Phan du a%b=$phandu<br>";
?>
<h2>5.2</h2>
<?php
    $a=12.2;
    if(is_int($a))
        echo "$a la so nguyen";
    else
        echo "$a la so thuc";
?>
<h2>5.3</h2>
<?php 
//ax^2+bx+c=0
    $a=8;
    $b=7;
    $c=9;
    if($a==0){
        echo "ko phai pt bac 2";
    }
    else{
        $delta=$b*$b-4*$a*$c;
        if($delta<0){
            echo "pt vn";
        } elseif($delta==0){
            $x=-$b/(2*$a);
            echo "pt nghiem kep: x=$x";
        } else{
            $x1=(-$b+sqrt($delta))/(2*$a);
            $x2=(-$b-sqrt($delta))/(2*$a);
            echo "pt 2 nghiem phan biet:<br>";
            echo "x1=$x1<br>x2=$x2<br>";
        }
    }
?>