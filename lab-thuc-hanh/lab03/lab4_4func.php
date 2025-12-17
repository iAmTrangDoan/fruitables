<?php	
function BCC($n,$colorHead="red",$color1="yellow",$color2="green")
{
    ?>
	$html .= "<thead>";
    $html .= "<tr style="background-color:{$colorHead};"><th>Bảng Cửu Chương {$n}</th></tr>";
    $html .= "</thead>";
	<tr><td colspan="3">Bảng cửu chương <?php echo $n;?></td></tr>
	<?php
		for($i=1; $i<=10; $i++)
		{
			?>
			<!-- <tr><td><?php echo $n;?></td>
				<td><?php echo $i;?></td>
				<td><?php echo $n*$i;?></td>
			</tr> -->
			
			<?php
		}
		?>
		</table>
	<?php
}
?>