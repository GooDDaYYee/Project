             <form action="insert_register.php" id="insert_users" method="post">
                 <!-- Begin Page Content -->
                 <div class="card o-hidden border-0 shadow-lg my-5">
                     <div class="card-body p-0">
                         <!-- Nested Row within Card Body -->
                         <div class="row">
                             <div class="col-lg">
                                 <div class="p-5">
                                     <div class="text-center">
                                         <h1 class="h2 text-gray-900 mb-2">เพิ่มผู้ใช้</h1>
                                     </div>
                                     <hr class="user">
                                     <div class="form-group row">
                                         <div class="col-sm-6 mb-3 mb-sm-0">
                                             <input type="text" id="name" name="name" class="form-control form-control-user" placeholder="ชื่อ" required="">
                                         </div>
                                         <div class="col-sm-6">
                                             <input type="text" id="lastname" name="lastname" class="form-control form-control-user" placeholder="นามสกุล" required="">
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <input type="text" id="username" name="username" class="form-control form-control-user" placeholder="Username" required="" autofocus="">
                                     </div>

                                     <div class="form-group">
                                         <input type="password" id="password" name="passW" class="form-control form-control-user" placeholder="Password" required="">
                                     </div>
                                     <div>
                                         <input type="radio" id="type" name="type" placeholder="type" value="0">
                                         <label for="type">แอดมิน</label>
                                         <input type="radio" id="type" name="type" placeholder="type" value="1">
                                         <label for="type">เจ้าของบริษัท</label>
                                         <input type="radio" id="type" name="type" placeholder="type" value="2">
                                         <label for="type">พนักงานเอกสาร</label>
                                         <input type="radio" id="type" name="type" placeholder="type" value="3">
                                         <label for="type">พนักงานปฏิบัติงาน</label>
                                     </div>
                                     <button class="btn btn-warning bg-gradient-purple btn-user btn-block" id="insert_users" type="submit">
                                         <h5>Submit</h5>
                                     </button>
                                 </div>


                             </div>
                         </div>
                     </div>
                 </div>
             </form>