<?php
function templates($a=''){
  return base_url('assets/templates/gentelella/'.$a);
}

function content_open($title=''){
  return '<div class="">
  <div class="page-title">
      <div class="title_left">
      <h3>'.$title.'</h3>
      </div>

      <div class="title_right">
          <div class="col-md-5 col-sm-5   form-group pull-right top_search">
              
          </div>
      </div>
  </div>

  <div class="clearfix"></div>
  <div class="row">
      <div class="col-md-12 col-sm-12  ">
          <div class="x_panel">
              <div class="x_title">
                  <h2>'.$title.'</h2>
                  <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  
                  </ul>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">';
}

function content_close($title=''){
  return '</div>
  </div>
</div>
</div>
</div>';
}

function assets($file=''){
    return base_url('assets/'.$file);
}