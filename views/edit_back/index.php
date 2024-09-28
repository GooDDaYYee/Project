<style>
    .scrollable-list {
        max-height: calc(5 * 58px);
        /* Approximate height of 5 items */
        overflow-y: auto;
    }

    .list-group-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .close-btn {
        cursor: pointer;
        padding: 0 5px;
        font-weight: bold;
        color: #777;
    }

    .close-btn:hover {
        color: #000;
    }
</style>

<?php
$data = $this->QryDb();
?>

<div class="text-center">
    <h1 class="h2 text-gray-900 mb-3">ข้อมูลเชิงลึก</h1>
</div>
<div class="container-xl">
    <div class="row">
        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4>เพิ่ม รับจากบริษัท</h4>
                    <div class="row">
                        <div class="col">
                            <input type="text" id="username" name="username" class="form-control form-control-user" placeholder="รับจากบริษัท" required autofocus>
                        </div>
                        <div class="col">
                            <button class="btn btn-warning bg-gradient-purple" type="submit">
                                ตกลง
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-4">
                            <div class="scrollable-list">
                                <ul class="list-group">
                                    <?php
                                    foreach ($data['drum_company'] as $row) {
                                        echo '<li class="list-group-item">';
                                        echo $row['drum_company_detail'];
                                        echo '<span class="close-btn">&times;</span>';
                                        echo '</li>';
                                    }
                                    ?>
                                    <!-- Add more items as needed -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4 ">
            <div class="card">
                <div class="card-body">
                    <h4>เพิ่ม บริษัทผลิตสาย</h4>
                    <div class="row">
                        <div class="col">
                            <input type="text" id="username" name="username" class="form-control form-control-user" placeholder="บริษัทผลิตสาย" required autofocus>
                        </div>
                        <div class="col">
                            <button class="btn btn-warning bg-gradient-purple" type="submit">
                                ตกลง
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-4">
                            <div class="scrollable-list">
                                <ul class="list-group">
                                    <?php
                                    foreach ($data['drum_cable_company'] as $row) {
                                        echo '<li class="list-group-item">';
                                        echo $row['drum_cable_company_detail'];
                                        echo '<span class="close-btn">&times;</span>';
                                        echo '</li>';
                                    }
                                    ?>
                                    <!-- Add more items as needed -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4 ">
            <div class="card">
                <div class="card-body">
                    <h4>เพิ่ม บริษัทที่ทำงาน</h4>
                    <div class="row">
                        <div class="col">
                            <input type="text" id="username" name="username" class="form-control form-control-user" placeholder="บริษัทที่ทำงาน" required autofocus>
                        </div>
                        <div class="col">
                            <button class="btn btn-warning bg-gradient-purple" type="submit">
                                ตกลง
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-4">
                            <div class="scrollable-list">
                                <ul class="list-group">
                                    <?php
                                    foreach ($data['cable_work'] as $row) {
                                        echo '<li class="list-group-item">';
                                        echo $row['cable_work_name'];
                                        echo '<span class="close-btn">&times;</span>';
                                        echo '</li>';
                                    }
                                    ?>
                                    <!-- Add more items as needed -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4>เพิ่ม AU ทั้งหมด</h4>
                    <p style="color: red;">*ข้อมูลเก่าจะถูกลบ และแทนที่ใหม่ทั้งหมด*</p>
                    <div class="row">
                        <form action="process.php" method="post" enctype="multipart/form-data">
                            <div class="col">
                                <input type="file" name="excelFile" accept=".xlsx, .xls" required>
                            </div>
                            <div class="col mt-2">
                                <input type="submit" value="Upload and Process">
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-4">
                            <h4>รายละเอียด</h4>
                            <p>AU : ทั้งหมด 555 รายการ | Mixed : 555 รายการ | FBH : 555 รายการ</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="col">
                        <h4>แก้ไขข้อมูลธนาคารภายใน Bill</h4>
                        <form action="process.php" method="post" enctype="multipart/form-data">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="6"><?php foreach ($data['bill_bank'] as $row) {
                                                                                                            echo $row['bank_detail'];
                                                                                                        } ?></textarea>
                        </form>
                    </div>
                    <div class="col mt-3 text-center">
                        <button class="btn btn-warning bg-gradient-purple" type="submit">
                            ตกลง
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="col">
                        <h4>แก้ไขข้อมูลที่อยู่บริษัท PSNK</h4>
                        <form action="process.php" method="post" enctype="multipart/form-data">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="6"><?php foreach ($data['company_address_psnk'] as $row) {
                                                                                                            echo $row['company_address_detaill'];
                                                                                                        } ?></textarea>
                        </form>
                    </div>
                    <div class="col mt-3 text-center">
                        <button class="btn btn-warning bg-gradient-purple" type="submit">
                            ตกลง
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="col">
                        <h4>แก้ไขข้อมูลที่อยู่บริษัท Mixed</h4>
                        <form action="process.php" method="post" enctype="multipart/form-data">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="6"><?php foreach ($data['company_address_mixed'] as $row) {
                                                                                                            echo $row['company_address_detaill'];
                                                                                                        } ?></textarea>
                        </form>
                    </div>
                    <div class="col mt-3 text-center">
                        <button class="btn btn-warning bg-gradient-purple" type="submit">
                            ตกลง
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="col">
                        <h4>แก้ไขข้อมูลที่อยู่บริษัท FBH</h4>
                        <form action="process.php" method="post" enctype="multipart/form-data">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="6"><?php foreach ($data['company_address_fbh'] as $row) {
                                                                                                            echo $row['company_address_detaill'];
                                                                                                        } ?></textarea>
                        </form>
                    </div>
                    <div class="col mt-3 text-center">
                        <button class="btn btn-warning bg-gradient-purple" type="submit">
                            ตกลง
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="col">
                        <h4>แก้ไขข้อมูลผู้ติดต่อ Mixed</h4>
                        <form action="process.php" method="post" enctype="multipart/form-data">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="6"><?php foreach ($data['company_address_mixed_contact'] as $row) {
                                                                                                            echo $row['company_address_name'];
                                                                                                        } ?></textarea>
                        </form>
                    </div>
                    <div class="col mt-3 text-center">
                        <button class="btn btn-warning bg-gradient-purple" type="submit">
                            ตกลง
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="col">
                        <h4>แก้ไขข้อมูลผู้ติดต่อ FBH</h4>
                        <form action="process.php" method="post" enctype="multipart/form-data">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="6"><?php foreach ($data['company_address_fbh_contact'] as $row) {
                                                                                                            echo $row['company_address_name'];
                                                                                                        } ?></textarea>
                        </form>
                    </div>
                    <div class="col mt-3 text-center">
                        <button class="btn btn-warning bg-gradient-purple" type="submit">
                            ตกลง
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
</script>