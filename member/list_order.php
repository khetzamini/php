<?php 
include ('../condb.php');
$sql = "SELECT *
FROM order_head
WHERE m_id=$m_id
";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);
?>
<h3>ประวัติการสั่งซื้อ</h3>
<table table id='example' class='display table table-bordered table-hover' cellspacing='0'> 
    <thead>
        <tr>
            <th width="5%"></th>
            <th width="10%">สถานะ</th>
            <th width="10%">วันที่-เวลาสั่งซื้อ</th>
            <th width="10%">ราคารวม</th>
            <th width="5%">สลิป</th>
            <th width="10%">เลข EMS</th>
            <th width="5%">วิว</th>
        </tr>
    </thead>
<tbody>
    <?php foreach($query as $row){ ?>
    <tr>
        <td align="center"><?php echo $row['o_id'];?></td>
        <td><?php 
        @$st = $row['o_status'];
        if($st==1){
            echo "<font color='blue'>";
            echo 'รอชำระเงิน';
            echo "</font>";
        }else if ($st==2){
            echo "<font color='green'>";
            echo 'ชำระเงินแล้ว';
            echo "</font>";
        }else if ($st==3){
            echo "<font color='orange'>";
            echo 'ตรวจสอบเลข EMS';
            echo "</font>";
        }else if ($st==4){
            echo "<font color='red'>";
            echo 'ยกเลิก';
            echo "</font>";
        }
        ?></td>
        <td><?php echo $row['o_dttm'];?></td>
        <td align="right"><?php echo number_format($row["o_total"],2);?></td>
        <td align="center"><img src="../imgslip/<?php echo $row['o_slip'];?>" alt="" width="100%"></td>
        <td><?php echo $row['o_ems'];?></td>
        <td><?php

        $o_id=$row['o_id'];
        if($st==1){
            echo "<a href='payment.php?o_id=$o_id&do=payment' class='btn btn-primary' btn-xs'>ชำระเงิน</a>";
        }else if ($st==2){
            echo "<a href='payment_detail.php?o_id=$o_id&do=payment_detail' class='btn btn-success' btn-xs'>เปิดดู</a>";
        }else if ($st==3){
            echo "<a href='payment_detail.php?o_id=$o_id&do=payment_detail'' class='btn btn-warning' btn-xs'>ดูเลข EMS</a>";
        }else{
            echo "<a href='order_detail.php?o_id=$o_id&do=order_detail'' class='btn btn-danger' btn-xs' target='blank'>เปิดดู</a>";
        }
        ?>
        </td>
</tr>
<?php } ?>
</tbody>
</table>