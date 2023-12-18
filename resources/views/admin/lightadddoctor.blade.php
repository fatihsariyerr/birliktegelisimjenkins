@include('admin.lightheader')
<body>
  
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
   @include('admin.lightsidebar')
    <!--  Main wrapper -->
    <div class="body-wrapper">
    @include('admin.lightnavbar')
      <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
        @if($bildirimler->count() > 0)
        
        <div class="col-lg-12 d-flex align-items-strech">
          <div class="card w-100">
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Bildirimler</h5>
                
        @foreach($bildirimler as $nots)
        <div class="alert alert-primary" role="alert">{{$nots->icerik}}</div>
        @endforeach
        <a href="{{url('okundu')}}" type="button" class="btn btn-outline-primary m-1">Tümünü Okudum</a>
        </div></div></div>
        @endif
                
          <div class="col-lg-12 d-flex align-items-strech">
          <div class="card w-100">
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Doktor Ekle</h5>
                <form action="{{url('lightupload_doctor')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Doktor Adı</label>
                      <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp">
                      </div>
                   
                      <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Telefon Numarası</label>
                      <input type="text" class="form-control" name="phone" id="exampleInputEmail1" aria-describedby="emailHelp">
                      </div>
                      <div class="mb-3">
                      <select class="form-select" name="speciality" >
                        <option >Bölümü</option>
                             <option value="Pedagog">Pedagog</option>
                            <option value="Psikolog">Psikolog</option>
                        </select>
                      </div>
                      <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Doktor Resmi</label>
                      <input class="form-control" type="file" name="file"> 
                      </div>
                  
                
                <div style="padding:15px;">
                <input type="submit" style="color:white;background-color:#5D87FF;" value="Ekle"  class="btn btn-outline-primary">
                </div>
            </form>
              </div>
            </div>
          
          </div>
        </div>
        <div class="py-6 px-6 text-center">
          <p class="mb-0 fs-4">Design and Developed by <a href="https://www.linkedin.com/in/fatihsariyer/" target="_blank" class="pe-1 text-primary text-decoration-underline">Fatih Sarıyer</a> </p>
       
        </div>
     
      </div>
    
    </div>
  </div>
  @include('admin.lightfooter')