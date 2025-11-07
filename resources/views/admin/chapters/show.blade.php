@extends('admin.layouts.app')
@section('title', 'Goforfit - show detail')

@section('content')
<style type="text/css">
  /* ------------------DashboardEvent--------------------- */

.e_head{padding:10px;background:#007bff ;border-top-left-radius: 7px;border-top-right-radius: 7px;;}

.e_head h2{font-size:18px;color:#fff;margin:0;font-weight: 400;;}

.e_head h2 span{padding:0 15px;}

.e_des{padding-top:15px;}

.e_img {margin:0 auto;text-align:center;margin-top:30px;}

.e_des ul{padding:0;margin:0;list-style: none;display: flex;justify-content: space-around;}

.e_des ul li{padding:10px 15px;border:1px solid #e1e1e1;width:48%;border-radius: 5px;;margin:5px 0;}

.e_sty_area{display:flex;justify-content: space-around;}

.e_sty{    width: 48%;

  margin: 5px 0;

  padding: 10px;

  border-left: 4px solid #FF9933;}

.ev_parent{

  border: 1px solid #e1e1e1;

  border-radius: 8px;

  padding-bottom: 20px;

 

}

.e_img img{

  object-fit: cover; 

  width: 150px;

  height: 120px;

  border: 1px solid #e2e2e2;

  padding: 5px;

  border-radius: 5px;

}

.e_des {padding-left:15px;padding-right: 15px;;}

.e_des p{text-align: center;}

.shadow_ev{

  box-shadow: 0 1px 8px rgb(0 0 0 / 10%);

  /* border: 1px solid #f5f5f5; */

}

.e_sty p{margin:0;text-align: left;}
</style>



<section>
<div class="container">
 <div class="row align-items-center">
    <div class=" col-sm-12  col-lg-12">
        <div class="ev_parent">
        <div class="e_head">
            <h2>Event Name :<span>Test Event1</span></h2>
        </div>
        <div class="e_des ">
          <ul>
             <li>
                <div><strong>Event Category :</strong></div>
                <div> Prabhat Pheri </div>
             </li>
              <li>
                <div><strong>KmRun :</strong></div>
                <div> 234 </div>
             </li>

              <li>
                <div><strong>KmRun :</strong></div>
                <div> 234 </div>
             </li>
              <li>
                <div><strong>KmRun :</strong></div>
                <div> 234 </div>
             </li>
              <li>
                <div><strong>KmRun :</strong></div>
                <div> 234 </div>
             </li>
              <li>
                <div><strong>KmRun :</strong></div>
                <div> 234 </div>
             </li>

              <li>
                <div><strong>KmRun :</strong></div>
                <div> 234 </div>
             </li>
              <li>
                <div><strong>KmRun :</strong></div>
                <div> 234 </div>
             </li>
          </ul>
    </div>
 </div>
</div>
</section>
@endsection