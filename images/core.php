<?php
namespace core;

class Core{   var $_deb=1; // 1- вывод служ. сообщений в тело.. 2 - запись в лог
   public function page(){
      global $path,$cache,$mysql,$bil,$prc;
      $this->obr();
      $this->getuser();
      $ut=$this->usermenu_get();
      $this->setup();
      $new=$newus='';

      if ($this->check_gr('3')===true) $newus='<a class="" href="'.SITE_URL.'proect/add/">Добавить проект</a>';
      if ($this->check_gr('1')===true) $newus.='<a class="" href="'.SITE_URL.'user/rekomend/">Приглашение другу</a>';
      if ($this->check_gr('6')===true) {      	$newus.='<a class="" href="'.SITE_URL.'klients/view/my/">Мои клиенты</a>';
      	$newus.='<a class="" href="'.SITE_URL.'user/komand/">Моя команда</a>';
      }
      if ($this->check_gr('15')===true) $newus.='<a class="" href="'.SITE_URL.'proect/backup/">Заявки на перенос сайтов '.$prc->col_host().'</a>';


      //echo $newus;

      $repl=array(
         'url'       => SITE_URL,
         'us_name'   => $this->_user['name'],
         'us_balans' => $bil->balans(),
         'us_balans2'=> $bil->balans_work(),//$this->_user['balans2'].' руб.',
         'cont'      => $this->content(),
         'proects'   => $this->proect_mini(),
         'menu'      => $ut,
         'new_mes'   => '',
         'new_proect'=> $new,
         'new_user'  => $newus,
         'help'      => $this->help()
      );
      $res=templ($path.'templ/core/index.html',$repl);
      return $res;
   }
   public function usermenu_get(){
     global $prc,$bil;
     $res='';
     /*
     INSERT INTO `user_group` (`ugid`, `gr_name`, `view`, `type`) VALUES
(1, 'Добавление пользователей', 1, ''),
(2, 'Доступ к кассе', 0, ''),
(3, 'Добавление проектов', 1, ''),
(4, 'Работа над проектом (исполнитель)', 1, ''),
(5, 'Оценка проектов', 1, ''),
(6, 'Работа с клиентами', 1, ''),
(7, 'Доступ к пользователям', 0, ''),
(8, 'Доступ к делу пользователя', 1, ''),
(98, 'Разработчик панели', 0, 's'),
(99, 'Админ', 0, 's');
     */
     // работа с пользователями (добавление и доступ к группам пользователей)

     if ($this->check_gr('7,99,98')===true){         $res.='<ul class="dropdown-menu"><li><a href="#">Пользователи</a><ul>';
         $res.='<li><A href="'.SITE_URL.'user/proger/">Программисты</a></li>';
         $res.='<li><A href="'.SITE_URL.'user/verst/">Верстальщики</a></li>';
         $res.='<li><A href="'.SITE_URL.'user/diz/">Дизайнеры</a></li>';
         $res.='<li><A href="'.SITE_URL.'user/pm/">ПМ-ы</a></li>';
         $res.='<li><A href="'.SITE_URL.'user/test/">Тестеры</a></li>';
         $res.='<li><A href="'.SITE_URL.'user/arbitr/">Арбитраж</a></li>';
         $res.='<li><A href="'.SITE_URL.'user/all/">Все</a></li>';
         $res.='<li><A href="'.SITE_URL.'user/add/">Новый пользователь</a></li>';
         $res.='</ul></li></ul>';
     }

     // проекты

     $res.=$prc->menu();
     //$res.='<ul class="dropdown-menu"><li><a href="#">Уведомления '.$this->get_new_messages().'</a></li></ul>';
     // админ или разработчик
     if ($this->check_gr('99,98')===true){
         $res.='<ul class="dropdown-menu"><li><a href="#">Админ</a><ul>';
         $res.='<li><A href="'.SITE_URL.'admin/us_online/">Пользователи онлайн</a></li>';
         $res.='<li><A href="'.SITE_URL.'admin/act_stat/">Статистика активности</a></li>';
         $res.='<li><A href="'.SITE_URL.'admin/klients/">Клиенты</a></li>';

         $res.='<li><a href="'.SITE_URL.'admin/tags/">Теги</a></li>';
         $res.='</ul></li></ul>';

         $res.=$bil->menu();

     }
     return $res;
   }
   function debug($text){   	  //echo $text."<br>" ;
   }
   function get_new_messages(){   	  return '';
   }
   function _user_info($uid){   	  $r=mysql_query("select * from `user`,`user_help` where user.uid=user_help.uid and user.uid='".$uid."' limit 0,30");
      $ar=mysql_fetch_array($r);
      return $ar;
   }
   function get_users_type($uid,$type){       $us='';
       $r=mysql_query("select * from `user`,us_gr where us_gr.uid=user.uid and us_gr.ugid=".$type." order by user.name asc");
       $t=mysql_num_rows($r);
       for ($y=0;$y<$t;$y++){
          $f=mysql_fetch_array($r);
          if ($uid==$f['uid']) $us.='<option value="'.$f['uid'].'" selected>'.$f['name'].'</option>';
          else $us.='<option value="'.$f['uid'].'">'.$f['name'].'</option>';
       }
       return $us;
   }
   function get_users_type_arr($type){
       $us=array();
       $r=mysql_query("select * from `user`,us_gr where us_gr.uid=user.uid and us_gr.ugid=".$type." order by user.name asc");
       $t=mysql_num_rows($r);
       for ($y=0;$y<$t;$y++){
          $f=mysql_fetch_array($r);
          $us[$f['uid']]=$f['name'];
       }
       return $us;
   }
   function setup(){      $r=mysql_query("select * from `system`");
      $f=mysql_fetch_array($r);
      $this->_sys=$f;
   }
   function getuser(){
      $sess=$this->_core['session'];
      $r=mysql_query("select * from user,user_help where user_help.uid=user.uid and user.uid='".$sess['user']."'");
      $ar=mysql_fetch_array($r);
      if (!isset($ar['uid'])){      	  header ('location: '.SITE_URL.'exit/');
      	  exit;
      }
      $r=mysql_query("select * from `us_gr`,user_group where us_gr.uid=".$sess['user']." and user_group.ugid=us_gr.ugid");
      $t=mysql_num_rows($r);

      $r2=mysql_query("select * from `user_tags` where uid='".$ar['uid']."'");
      $t2=mysql_num_rows($r2);
      $tags=array();
      for ($i=0;$i<$t2;$i++){      	 $f2=mysql_fetch_array($r2);
      	 $tags[]=$f2['tagid'];
      }


      $grp='';
      for ($y=0;$y<$t;$y++){
          $f=mysql_fetch_array($r);
          $this->debug($f['gr_name']);
          $grp.=':'.$f['ugid'].':';
      }
      $this->_user=$ar;

      $this->_user_gr=$grp;
      $this->_user_tag=$tags;


   }
   function check_gr($str){
      $arr=explode(',',$str);   	  for ($i=0;$i<count($arr);$i++){   	  	if (strstr($this->_user_gr,':'.$arr[$i].':')) return true;
   	  }
   	  return false;
   }
   public function obr(){
   	  global $check;
      $this->_core['get']=$check->get($_GET);
      $this->_core['session']=$check->get($_SESSION);
      $this->_core['post']=$check->get($_POST);
      $this->_core['cookie']=$check->get($_COOKIE);
      $this->_core['file']=$check->get($_FILES);
   }
   function get_tags(){        $r2=mysql_query("select * from tags order by name asc");
        $t2=mysql_num_rows($r2);
        if ($t2==0) $tags=array();
        else {
           for ($y=0;$y<$t2;$y++){
              $f2=mysql_fetch_array($r2);
              $tags['name'][]=$f2['name'];
              $tags['id'][]=$f2['tag_id'];
           }
        }
        return $tags;
   }
   function us_exit(){      unset($_SESSION['user']);
      header ('location: '.SITE_URL);
      exit;
   }
   static function _header($to=''){      if ($to=='') return false;
      header ('location: '.SITE_URL.$to);
      exit;
   }


   function help(){     $get=$this->_core['get'];
     if (!isset($get['p'])){
     	 $get['p']='index';
     }
     $user=$this->_user;
     switch($get['p']){
        case 'index'    : if ($user['help_home']==0) return '<input id="isfirsttime" type="hidden" val="true">'; else return '<input id="isfirsttime" type="hidden" val="false">'; break;
        /*
        case 'admin'    : return $admin->start();
        case 'billing'  : return $bil->start(); break;
        //case 'banks'    : return $this->banks(); break;
        case 'proect'   : return $this->proect(); break;
        case 'exit'     : return $this->us_exit();break;
        //case 'obzvon'   : return $this->obzvon();break;
        case 'user'     : return $this->viewuser();break;
        //case 'account'  : return $this->account(); break;
        //case 'stat'     : return $this->gstat(); break;
        case 'support'  : return $this->support(); break;
        case 'mes'      : return $this->getmes();
        */
     }
   }
   public function content(){
     global $admin,$bil,$klients;
     $get=$this->_core['get'];
     if (!isset($get['p'])){
     	 $get['p']='index';
     }
     //print_r($get);exit;
     switch($get['p']){
        case 'index'    : return $this->index(); break;
        case 'admin'    : return $admin->start();
        case 'billing'  : return $bil->start(); break;
        //case 'banks'    : return $this->banks(); break;
        case 'proect'   : return $this->proect(); break;
        case 'klients'   : return $klients->start(); break;

        case 'exit'     : return $this->us_exit();break;
        //case 'obzvon'   : return $this->obzvon();break;
        case 'user'     : return $this->viewuser();break;
        //case 'account'  : return $this->account(); break;
        //case 'stat'     : return $this->gstat(); break;
        case 'support'  : return $this->support(); break;
        case 'mes'      : return $this->getmes();
     }
   }
   function getmes(){
       if (isset($_SESSION['text'])) {
       	$text=$_SESSION['text'];
        unset($_SESSION['text']);
   	   }
   	   else {
   	   	  header('location '.SITE_URL);
   	   	  exit;
   	   }
   	   return templ('templ/core/any/mes.html',array('text'=>$text));
   }
   function mes($text){
   	   $_SESSION['text']=$text;
   }
   function support(){
       global $mysql;
       $post=$this->_core['post'];
       if (isset($post['text'])){
       	   $arr=array(
       	      'text'   => $post['text'],
       	      'uid'    => $this->_user['uid'],
       	      'caption'=> $post['name']
       	   );
       	   $mysql->insert($arr,"support");
       	   $this->mes('Спасибо, Мы ответим на Ваше обращение в ближайшее время.');
       	   header ('location: '.SITE_URL.'mes/');
       	   exit;
       }

       return templ('templ/core/any/support.html',array());
   }

   function sendmail($mail,$type,$arr){
      $r=mysql_query("select * from `templ_mail` where name='".$type."'");
      $f=mysql_fetch_array($r);

      $rr=array('from'=>array(
         '%mail%',
         '%pas%',
         '%url%'
      ),
      'to'=>array(
         $arr['mail'],
         $arr['pas'],
         SITE_URL
      ));
      $mail2=$arr['mail'];
      $text=str_replace($rr['from'],$rr['to'],$f['text']);
      //echo $text;exit;
      //print_r($f);exit;
      //echo $mail.' - '.$f['tema'].' - '.$f['mail_from'].' - '.$f['sender'];exit;
      //echo $text;exit;
      $mail = new Mail($f['mail_from']); // Создаём экземпляр класса
      $mail->setFromName($f['sender']); // Устанавливаем имя в обратном адресе
      if ($mail->send($mail2, $f['tema'], $text)) return true;
      else return false;
   }

   function _not_enter(){   	   return templ('templ/core/any/mes.html',array('text'=>'У Вас нет необходимых прав для просмотра данного раздела','url'=>SITE_URL));
   }

   function get_user_group($uid){
        //echo "select * from us_gr,user_group where us_gr.uid=".$uid." and user_group.ugid=us_gr.ugid";exit;        $r=mysql_query("select * from us_gr,user_group where us_gr.uid=".$uid." and user_group.ugid=us_gr.ugid");
        $t=mysql_num_rows($r);
        //echo $uid."\n\n";
        //echo $t;exit;
        for ($y=0;$y<$t;$y++){
            $f=mysql_fetch_array($r);
            $rr[]=$f['gr_name'];
        }
        $res=implode(', ',$rr);
        return $res;
        //exit;
   }

   function viewuser(){
        global $mysql;
        $post=$this->_core['post'];
        $get=$this->_core['get'];
        //echo "<!--";print_r($get);echo "!-->";
        $res='';

        if (isset($post['user_coment'])){        	 if ($this->check_gr('7,99,98')===false) return $this->_not_enter();
        	 $arr=array(
        	    'date' => date('U'),
        	    'from' => $this->_user['uid'],
        	    'uid'  => $post['user_coment'],
        	    'text' => $post['coment'],
        	    'type' => $post['type']
        	 );
        	 $mysql->insert($arr,"user_coments");
        	 header ('location: '.SITE_URL.'user/edit/'.$post['user_coment']);
        	 exit;
        }
        if (isset($post['edit_user'])){
            $uid=$post['edit_user'];
            //echo $uid;exit;
            $type=$post['type'];
            $tags=$post['tag'];
            unset($post['tag']);
        	unset($post['type']);
        	unset($post['edit_user']);

            $sql='DELETE FROM `us_gr` WHERE uid='.$uid;
            mysql_query($sql);
            for ($i=0;$i<count($type);$i++){
                if ($type[$i]==99){                	$r=mysql_query("select * from `us_gr` where uid='.$uid.' and ugid=99");
                    $f=mysql_fetch_array($r);
                    if (isset($f['uid'])) continue;
                }
            	$arr=array('ugid'=>$type[$i],'uid'=>$uid);
            	$mysql->insert($arr,'us_gr');
            }

            $sql='DELETE FROM `user_tags` WHERE uid='.$uid;
            mysql_query($sql);


            $tag=$tags;//explode(',',$tags);
            //print_r($tag);exit;
            for($i=0;$i<count($tag);$i++){
                if (trim($tag[$i])=='') continue;
            	$tid=$tag[$i];
                $arr=array('uid'=>$uid,'tagid'=>$tid);
                $mysql->insert($arr,"user_tags");
            }

            /*
            $tag=explode(',',$tags);
            for ($i=0;$i<count($tag);$i++){
            	$arr=array('ugid'=>$type[$i],'uid'=>$uid);
            	//print_r($arr);
                $mysql->insert($arr,'us_gr');
            }
            */
            //exit;
            //print_r($post);exit;
            //echo "uid=".$uid;exit;

            if ($post['newpas']!=''){            	$post['pas']=md5($post['newpas']);
            }
            unset($post['newpas']);
            //print_r($post);exit;

            $mysql->update($post,'user',"uid=".$uid);
            header ('location: '.SITE_URL.'user/edit/'.$uid);
        	exit;
            print_r($post);exit;
        }
        if (isset($post['new_user'])){
        	//print_r($post);exit;
        	if (isset($post['type'])) $type=$post['type']; else $type=array();
        	$tags=$post['tag'];
            //print_r($tags);exit;
        	unset($post['tag']);
        	unset($post['type']);
        	unset($post['new_user']);
        	$pas=substr(md5(rand(0,99).$post['mail'].date('U')),0,8);
            $post['pas']=md5($pas);
            $post['date']=date('U');
            $post['from_uid']=$this->_user['uid'];
            if ($post['stavka']==0) $post['stavka']=300;
            if ($post['koef']==0) $post['koef']=30;
            if ($post['reit']==0) $post['reit']=300;
        	$uid=$mysql->insert($post,'user');
            $post['pas']=$pas;
            $tag=$tags;
            for($i=0;$i<count($tag);$i++){
                if (trim($tag[$i])=='') continue;                $tid=$tag[$i];
                $arr=array('uid'=>$uid,'tagid'=>$tid);
                $mysql->insert($arr,"user_tags");
            }

            for ($i=0;$i<count($type);$i++){            	$arr=array('ugid'=>$type[$i],'uid'=>$uid);
                $mysql->insert($arr,'us_gr');
            }

            $this->sendmail($post['mail'],'newuser',$post);//===false) exit('hren');

            $arr=array('uid'=>$uid);
            $mysql->insert($arr,"user_help");

            header ('location: '.SITE_URL.'user/all/');
        	exit;
        }
        if (isset($post['new_group'])){
        	unset($post['new_group']);
        	$post['view']=1;
        	$mysql->insert($post,'user_group');
        	header ('location: '.SITE_URL.'user/add/');
        	exit;
        }
        if (isset($post['profil_user'])){            $arr=$post;
            unset($arr['profil_user']);
            if (!isset($arr['pas']) and $arr['pas']!=''){            	unset($arr['pas']);
            	unset($arr['oldpas']);
            }
            elseif ($arr['pas']!='' and $arr['oldpas']!='' and md5($arr['oldpas'])==$this->_user['pas']){            	unset($arr['oldpas']);
            	$arr['pas']=md5($arr['pas']);
            }
            else {            	unset($arr['pas']);
            	unset($arr['oldpas']);
            }
            //print_r($arr);exit;
            $mysql->update($arr,"user","uid=".$this->_user['uid']);
            header ('location: '.SITE_URL.'user/setup/');
        	exit;
        }
        // страница профиля пользователя
        if (isset($get['type']) and $get['type']=='komand'){            $res='<h2>Моя команда</h2><ul class="user_online">';
            //print_r($this->_user);exit;
        	$r=mysql_query("select * from user where to_pm=".$this->_user['uid']);
        	$t=mysql_num_rows($r);
        	for ($y=0;$y<$t;$y++){
          	  $f=mysql_fetch_array($r);
          	  $sum=0;

         	  $dostup=$this->get_user_group($f['uid']);
         	  $res.='<li><a href="'.SITE_URL.'mess/'.$f['uid'].'/">'.$f['name'].'</a> ('.$dostup.')';
         	  $res.='</li>';
        	}
        	$res.='</ul>';
        	return $res;
        }
        if (isset($get['type']) and $get['type']=='setup'){            $user=$this->_user;
            $r=$user;
            $res=templ('templ/core/user/profil.html',$r);
            return $res;
        }

        // обработка нового юзера
        if (isset($get['type']) and $get['type']=='rekomend'){             if ($this->check_gr('1')===false) return $this->_not_enter();
             $u_type=$this->typeuser();

             $tags=$this->get_tags();
             $tag='';
             for ($i=0;$i<count($tags['name']);$i++){
               $tag.='<input name="tag[]" type="checkbox" value="'.$tags['id'][$i].'" id="tag_'.$tags['id'][$i].'"> <label for="tag_'.$tags['id'][$i].'">'.$tags['id'][$i].' - '.$tags['name'][$i].'</label>';
             }

             if ($this->check_gr('99')===true){
               $dop='<div class="user-form-line">
			<div class="line-name"><label for="new_user_cont">Процент от ЧП : </label></div>
			<div class="line-body">
				<input id="new_user_cont" type="text" placeholder="Процент от ЧП" name="proc" value="">
			</div>
		</div>';
		     }

             $res=templ('templ/core/user/rek_user.html',array('type'=>$u_type,'tags'=>$tag));
             return $res;
        }

        if ($get['type']=='edit'){        	if ($this->check_gr('7,99,98')===false) return $this->_not_enter();
        	$u_type=$this->typeuser($get['uid']);
            $r=mysql_query("select * from `user` where uid=".$get['uid']);
            $r=mysql_fetch_array($r);

            $r['type']=$u_type;
            $r['uid']=$get['uid'];

            $tags=$this->get_tags();

            $tag='';
            for ($i=0;$i<count($tags['name']);$i++){

               $r3=mysql_query("select * from `user_tags` where tagid=".$tags['id'][$i]." and uid=".$get['uid']);
               $f3=mysql_fetch_array($r3);

               if (isset($f3['utid'])) $tag.='<input name="tag[]" type="checkbox" value="'.$tags['id'][$i].'" id="tag_'.$tags['id'][$i].'" checked> <label for="tag_'.$tags['id'][$i].'">'.$tags['id'][$i].' - '.$tags['name'][$i].'</label>'."\n";
               else $tag.='<input name="tag[]" type="checkbox" value="'.$tags['id'][$i].'" id="tag_'.$tags['id'][$i].'"> <label for="tag_'.$tags['id'][$i].'">'.$tags['id'][$i].' - '.$tags['name'][$i].'</label>'."\n";
            }

            $r['tags']=$tag;

            $com='';
            if ($this->check_gr('8,99,98')===true){
             $r2=mysql_query("select * from `user_coments` where uid=".$get['uid']);
             $t2=mysql_num_rows($r2);
             if ($t2==0) $com='';
             else {
              for ($y=0;$y<$t2;$y++){
                 $f2=mysql_fetch_array($r2);
                 $r3=mysql_query("select * from `user` where uid=".$f2['from']);
                 $f3=mysql_fetch_array($r3);
                 $arr=array(
                    'from' => $f3['name'],
                    'date' => date('d-m-Y H:i',$f2['date']),
                    'text' => $f2['text'],
                    'type' => $f2['type']
                 );
                 $com.=templ('templ/core/user/one_coment.html',$arr);
              }
             }

             $delo=array(
               'uid'     => $get['uid'],
               'coments' => $com
             );
             $r['delo']=templ('templ/core/user/user_delo.html',$delo);
            }
            else $r['delo']='';

            $r['dop']='';
            if ($this->check_gr('99')===true){
               $r['dop']='<div class="user-form-line">
			<div class="line-name"><label for="new_user_cont">Процент от ЧП : </label></div>
			<div class="line-body">
				<input id="new_user_cont" type="text" placeholder="Процент от ЧП" name="proc" value="'.$r['proc'].'">
			</div>
		</div>';
		    }

             $res=templ('templ/core/user/edit_user.html',$r);
             //echo $res;exit;

        }
        elseif ($get['type']=='add'){
           if ($this->check_gr('7,99,98')===false) return $this->_not_enter();
           $u_type=$this->typeuser();

           $tags=$this->get_tags();
           $tag='';
           for ($i=0;$i<count($tags['name']);$i++){               $tag.='<input name="tag[]" type="checkbox" value="'.$tags['id'][$i].'" id="tag_'.$tags['id'][$i].'"> <label for="tag_'.$tags['id'][$i].'">'.$tags['id'][$i].' - '.$tags['name'][$i].'</label>';
           }

           if ($this->check_gr('99')===true){
               $dop='<div class="user-form-line">
			<div class="line-name"><label for="new_user_cont">Процент от ЧП : </label></div>
			<div class="line-body">
				<input id="new_user_cont" type="text" placeholder="Процент от ЧП" name="proc" value="">
			</div>
		</div>';
		   }
           else $dop='';

           $res=templ('templ/core/user/add_user.html',array('type'=>$u_type,'tags'=>$tag,'dop'=>$dop));
           $res.=templ('templ/core/user/add_user_group.html',array('type'=>$u_type));
        }
        else {
        	$res='<ul class="user_list">';
            if ($get['type']=='del'){
                $uid=$get['uid'];                $sql='DELETE FROM `us_gr` WHERE uid='.$uid;
                mysql_query($sql);
                $sql='DELETE FROM `user` WHERE uid='.$uid;
                mysql_query($sql);
                $sql='DELETE FROM `user_tags` WHERE uid='.$uid;
                mysql_query($sql);
                header ('location: '.SITE_URL.'user/all/');
        	    exit;

            	exit('123123');
            }
            if ($get['type']=='all'){
             if ($this->check_gr('7,99,98')===true){
               $r=mysql_query("select * from `user`");
               $t=mysql_num_rows($r);
               for ($y=0;$y<$t;$y++){
                 $f=mysql_fetch_array($r);
                 $sum=0;

                 $dostup=$this->get_user_group($f['uid']);

                 $res.='<li><a href="'.SITE_URL.'user/edit/'.$f['uid'].'">'.$f['name'].'</a> ('.$dostup.')';
                 if ($this->check_gr('99,98')===true){                 	$res.=' <a href="'.SITE_URL.'user/del/'.$f['uid'].'"><font color=red>[x]</font></a>';
                 }
                 $res.='</li>';
               }
        	   $res.='</ul>';
        	   $zag='Все пользователи панели';
        	 }
        	 else {        	 	$res=$this->_not_enter();
        	 	$zag='Доступ ограничен';
        	 }
            }
            else {            	return 'В настоящий момент доступен просмотр только <a href="'.SITE_URL.'user/all/">всех пользователей</a>.';
            }
            return templ('templ/core/user/user_list.html',array('user_list'=>$res,'zag'=>$zag));
        }
        return $res;
   }
   function typeuser($uid=''){
   	  $res='';
   	  if ($this->check_gr('99,98')===false){   	  	  $r=mysql_query("select * from `user_group` where view=1");
   	  }
      else $r=mysql_query("select * from `user_group`");
      $t=mysql_num_rows($r);
      for ($y=0;$y<$t;$y++){
        $f=mysql_fetch_array($r);
        if ($f['view']==0 and $this->check_gr('99,98')===false) continue;
        if ($f['ugid']==99 and $this->check_gr('99')===false) continue;
        if ($f['ugid']==55 and $this->check_gr('99')===false) continue;


        if ($uid!=''){        	$r2=mysql_query("select * from `us_gr` where uid=".$uid." and ugid=".$f['ugid']);
            $f2=mysql_fetch_array($r2);
            if (isset($f2['ugid'])){            	$res.='<input name="type[]" type="checkbox" value="'.$f['ugid'].'" id="lab_'.$f['ugid'].'" checked> <label for="lab_'.$f['ugid'].'">'.$f['ugid'].' - '.$f['gr_name'].'</label>';
            }
            else  $res.='<input name="type[]" type="checkbox" value="'.$f['ugid'].'" id="lab_'.$f['ugid'].'"> <label for="lab_'.$f['ugid'].'">'.$f['ugid'].' - '.$f['gr_name'].'</label>';
        }
        else $res.='<input name="type[]" type="checkbox" value="'.$f['ugid'].'" id="lab_'.$f['ugid'].'"> <label for="lab_'.$f['ugid'].'">'.$f['ugid'].' - '.$f['gr_name'].'</label>';
      }



      //print_r($arr);exit;
      //echo $res;exit;

      return $res;
   }


   function klient_select(){		$res='';
		$r=mysql_query("select * from klients order by kl_name asc");
		$t=mysql_num_rows($r);
		for ($y=0;$y<$t;$y++){
			$f=mysql_fetch_array($r);
            $res.='<option value="'.$f['kid'].'">'.$f['kl_name'].'</option>';
		}
		return $res;
   }
   function proect_mini(){   	 return '<br>';//'<p>Тут отображаются проекты требующие Вашего участия(перевод в работу, подтверждение, оценка и т.п.)</p>';
   }
   // формирование страниц
   function new_proect(){   	   global $klients;
   	   //exit('1');
   	   $repl=array(
            'klients' => $klients->kl_select(),
            'url'     => SITE_URL
       );
       return templ('templ/core/forms/newproect.html',$repl);
   }
   function get_myproect(){      $user=$this->_user;
      $get=$this->_core['get'];
      if ($this->check_gr('4,99,98,5,3')===false) return $this->_not_enter();

      if (!isset($get['pa'])) {
      	$get['pa']='visp';
      }
      switch($get['pa']){      	 case 'ocenka' : $wh='type=1'; $wh2='and proect.type="1"'; $ty='Оценка'; break;
      	 case 'visp'   : $wh='type=2'; $wh2='and proect.type="2"'; $ty='Новые'; break;
      	 case 'work'   : $wh='type=3'; $wh2='and proect.type="3"'; $ty='Мои задачи'; break;
      	 case 'test'   : $wh='type=4'; $wh2='and proect.type="4"'; $ty='Тестирование'; break;
      	 case 'klient' : $wh='type=5'; $wh2='and proect.type="5"'; $ty='Проверка Клиентом'; break;
      	 case 'end'    : $wh='type=6'; $wh2='and proect.type="6"'; $ty='Завешенные'; break;
      	 default: {$wh='and type=2';  $wh2='and proect.type=2'; }
      }
      //echo "select * from `proect` where ".$wh." order by date asc";
      if ($this->check_gr('1')===true){      	 $r=mysql_query("select * from `proect` where ".$wh." order by date desc");
      }
      else {      	$r=mysql_query("select * from proect_user,`proect` where proect_user.uid=".$user['uid']." and proect.pid=proect_user.pid ".$wh2." group by proect_user.uid order by proect.date desc");
      }
      $t=mysql_num_rows($r);
      $res='<h3>Проекты с моим участием / '.$ty.'</h3>';

      for ($y=0;$y<$t;$y++){
         $f=mysql_fetch_array($r);
         if ($f['type']==1){         	 $stat='Необходима оценка';
         	 $price='0';
         }
         elseif ($f['type']==2) {         	 $stat='Выбор исполнителя';
         	 $price=$f['time'];
         }
         //echo $stat;
         $repl=array(
            'descr'   => mb_substr($f['descr'],0,200),
            'url'     => SITE_URL,
            'name'    => $f['name'],
            'price'   => $price,
            'status'  => $stat,
            'pid'     => $f['pid'],
         );
         $res.= templ('templ/core/proect/one_proect.html',$repl);
      }
      $type_proect='';
      if ($this->check_gr('4,99,98')===true) {
         if ($this->check_gr('5,99,98')===true) $type_proect.='<li><A href="'.SITE_URL.'proect/my/ocenka/">Оценка</a></li>';
         $type_proect.='<li><A href="'.SITE_URL.'proect/my/visp/">Новые</a></li>';
         $type_proect.='<li><A href="'.SITE_URL.'proect/my/work/">Мои задачи</a></li>';
         $type_proect.='<li><A href="'.SITE_URL.'proect/my/test/">Тестирование</a></li>';
         $type_proect.='<li><A href="'.SITE_URL.'proect/my/klient/">Проверка Клиентом</a></li>';
         $type_proect.='<li><A href="'.SITE_URL.'proect/my/end/">Завершенные</a></li>';
         if ($this->check_gr('3,99,98')===true) $type_proect.='<li><A href="'.SITE_URL.'proect/add/">Добавить проект</a></li>';
      }

      $res=templ('templ/core/proect/proect_cont.html',array('cont'=>$res,'url'=>SITE_URL,'type'=>$type_proect));
      return $res;
   }
   function full_proect($pid){      $user=$this->_user;
      $res='';
      $r=mysql_query("select * from `proect` where pid=".$pid." order by date asc");
      $f=mysql_fetch_array($r);
      $dop='';
      if ($f['type']==1){
         	 $stat='Необходима оценка';
         	 $price='Необходима оценка';
      }
      elseif ($f['type']==2) {
         	 $stat='Выбор исполнителя';
         	 $price=$f['time'];
      }
      if ($f['type']==1 and $this->check_gr('5,1')===true){      	$dop='<input name="chas" type="text" value="" placeholder="Кол-во часов">';
      	$dop.='<input type="submit" value="Оценил!" name="btn_ok"><br>
      	<textarea name="quest" placeholder="Доп вопросы. задача не ясна и требует дополнений"></textarea><Br>
      	<input name="btn_back" type="submit" value="Вернуть в отдел продаж">
      	';
      }
      //exit('13123');

      $repl=array(
            'descr'   => $f['descr'],
            'url'     => SITE_URL,
            'name'    => $f['name'],
            'price'   => $price,
            'status'  => $stat,
            'pid'     => $f['pid'],
            'dop'     => $dop
      );
      //print_r($repl);
      $res.= templ('templ/core/full_proect.html',$repl);

      return $res;
      return 'Полная инфа по проекту - '.$pid;
   }
   function proect(){      global $mysql,$prc;

      return $prc->start();//$post,$get,$user



      if (isset($get['t']) and $get['t']=='all' or $get['t']=='my'){      	  return $this->get_myproect();
      }
      if (isset($get['t']) and $get['t']=='add' and !isset($post['new_proect'])){          return $this->new_proect();
      }
      if (isset($post['new_proect'])){          unset($post['new_proect']);
          $tags=$post['ntags'];
          unset($post['ntags']);
          $file=$_FILES['file'];
          if ($post['klient']=='new'){             $klient=array(
               'kl_name'   => $post['kl_name'],
               'kl_company'=> $post['kl_company'],
               'kl_info'   => $post['kl_info']
             );
             $kid=$mysql->insert($klient,"klients");
          }
          else {             $kid=$post['klient'];
          }
          unset($post['kl_name']);
          unset($post['kl_company']);
          unset($post['kl_info']);
          unset($post['klient']);
          $post['date']=date('U');
          $post['uid']=$user['uid'];
          //print_r($post);exit;
          $pid=$mysql->insert($post,"proect");

          $kl=array('pid'=>$pid,'kid'=>$kid,'kp_date'=>date('U'));
          $mysql->insert($kl,"proect_klient");

          $arr=array(
             'pid'     => $pid,
             'uid'     => $user['uid'],
             'pu_date' => date('U'),
             'pu_comment'=> 'Проект создан',
          );

          $mysql->insert($arr,"proect_user");
          if (isset($file['name'][0]) and trim($file['name'][0])!=''){
             // создаем папку под проект
             mkdir('upload/'.$pid,0755);             for ($i=0;$i<count($file['name']);$i++){                copy($file['tmp_name'][$i],"upload/".$pid.'/'.$file['name'][$i]);
                $arr=array(
                   'name' => $file['name'][$i],
                   'pid'  => $pid
                );
                $mysql->insert($arr,"proect_files");
             }
          }

          // добавляем теги к проекту
          $tag=explode(",",$tags);
          for ($i=0;$i<count($tag);$i++){             $r=mysql_query("select * from `tags` where name='".trim($tag[$i])."'");
             $f=mysql_fetch_array($r);
             if (!isset($f['tag_id'])){             	$ar=array('name'=>trim($tag[$i]));
             	$tid=$mysql->insert($ar,"tags");
             	$ar=array('tag_id'=>$tid,'pid'=>$pid);
             	$mysql->insert($ar,"proect_tag");
             }
             else {             	$ar=array('tag_id'=>$f['tag_id'],'pid'=>$pid);
             	$mysql->insert($ar,"proect_tag");
             }
          }
          header ('location: '.SITE_URL.'proect/');
          exit;
      }

      if (isset($get['t'])){      	 $pid=$get['t'];
      	 return $this->full_proect($pid);
      	 print_r($pid);exit;
      }


      // выводим все мои проекты

      $res='';
      $r=mysql_query("select * from `proect` where uid=1 order by date asc");
      $t=mysql_num_rows($r);
      for ($y=0;$y<$t;$y++){
         $f=mysql_fetch_array($r);
         $res.='<div id="item">'.$f['name'].'<Br>'.$f['descr'].'</div>';
      }
      //echo $res;exit;
      return $res;
      //print_r($_POST);exit;
   }
   function index(){      global $admin;
      $res='';
      // выводим на главной сводную статистику...
      if ($this->check_gr('98,99')===true){          $res.=$admin->work_stat();
      }
      return $res;
   }


}


?>