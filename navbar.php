<?php 
$query = "SELECT t.*, COUNT(p.p_id) as ptotal 
FROM tbl_prd_type as t 
LEFT JOIN tbl_prd as p ON t.t_id=p.ref_t_id
GROUP BY t.t_id" or die("Error:" . mysqli_error());
$result = mysqli_query($conn, $query); 
 ?> 
    <!--start  menu -->
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-12">
          <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.php">สยามเหล็กไทย</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                  <?php
                  if(!empty($_SESSION['m_name'])){
                    echo '<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">สวัสดีครับคุณ '.$_SESSION['m_name'];
                    echo '</a><ul class="dropdown-menu">';
                    echo '<a class="dropdown-item" href="member/index.php?act=edit">แก้ไขโปรไฟล์</a>';
                    echo '<a class="dropdown-item" href="member/index.php">ประวัติการสั่งซื้อ</a>';
                    echo '<a class="dropdown-item" href="member/index.php?act=pwd">แก้ไขรหัสผ่าน</a>';
                    echo '<a class="dropdown-item" href="logout.php">ออกจากระบบ</a>';
                    echo '</a></ul></li>';
                  }else{
                    echo '<li class="nav-item"><a class="nav-link" href="login.php">เข้าสู่ระบบ</a></li>';
                    echo '<li class="nav-item"><a class="nav-link" href="register.php">สมัครสมาชิก</a></li>';
                  }
                  ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">เลือกประเภทสินค้า</a>
                    <ul class="dropdown-menu">
                      <?php  while($row = mysqli_fetch_array($result)) { ?>
                      <li>
                        <a class="dropdown-item" href="index.php?act=showbytype&t_id=<?php  echo $row["t_id"];?>&name=<?php  echo $row["t_name"];?>"> 
                          <?php  echo $row["t_name"];?> 
                        (<?php  echo $row["ptotal"];?>) </a></li>
                    <?php } ?>
                    </ul>
                  </li>

                <li class="nav-item">
              </ul>
              <form class="form-inline my-2 my-lg-0" method="get" action="index.php">
                <input class="form-control mr-sm-2" type="search" placeholder="ค้นหาชื่อสินค้า" name="search" required>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="act" value="q">ค้นหา</button>
              </form>
            </div>
          </nav>
        </div>
      </div>
    </div>
    <!--end  menu -->