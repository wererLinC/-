<?php
namespace Admin\Controller;
use Think\Controller;
class FileController extends Controller
{

    //照片列表
    public function imgList()
    {
        //全部消息列表的分页
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 14; //一页展示的数目
        $offset = ($page - 1) * $pageSize;

        $imgCount = M('image')->count();
        $fileCount = M('file')->count();
        //从charge表中查找所有的信息
        $maps['community'] = $_SESSION[admin][community];
        $imgInfo = M('image')
            ->where($maps)
            ->limit($offset, $pageSize)
            ->select();
        $res = getpage($imgCount, $pageSize);
        $pageRes = $res->show();
        //往前端送值过去
        $this->assign('pageRes', $pageRes);
        $this->assign('imgInfo', $imgInfo);

        $this->assign('imgCount', $imgCount);
        $this->assign('fileCount', $fileCount);
        $this->display();
    }

    //照片删除
    public function imgDel()
    {
        $maps['id'] = $_POST['id'];
        $imgInfo = M('image')->where($maps)->find();
        $url = $imgInfo['url'];
	   $imgUrl = "./Uploads".$url; 
	   $imgUrl =iconv("UTF-8","gbk",$imgUrl );
        if (unlink( $imgUrl )) {
            if (M('image')->where($maps)->delete()) {
                return show(1, 'success');
            } else {
                return show(0, 'failed');
            }
        } else {
            return show(0, '删除文件夹里的文件失败');
        }
    }

    public function fileList()
    {
        //全部消息列表的分页
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = $_REQUEST['pageSize'] ? $_REQUEST['pageSize'] : 3; //一页展示的数目
        $offset = ($page - 1) * $pageSize;

        $imgCount = M('image')->count();
        $fileCount = M('file')->count();
        //从charge表中查找所有的信息
        $fileInfo = M('file')
            ->limit($offset, $pageSize)
            ->select();
        $res = getpage($fileCount, $pageSize);
        $pageRes = $res->show();
        //往前端送值过去
        $this->assign('pageRes', $pageRes);
        $this->assign('fileInfo', $fileInfo);

        $this->assign('imgCount', $imgCount);
        $this->assign('fileCount', $fileCount);
        $this->display();
    }

    //文件增加页面
    public function addFile()
    {
        $this->display();
    }

    //添加文件的方法
    public function fileAdd(){
	
	$data['uploadAdmin'] = $_POST['uploadAdmin'];
	$data['fileNote'] = $_POST['fileNote'];
	$data['uploadTime'] = time();

	$upload = new \Think\Upload();
       $upload->maxSize = 0;
       $upload->exts = array('doc', 'docx', 'xls', 'xlsx', 'pdf', 'txt');
	$upload->saveRule = '';
          $upload->saveName = '';
          $upload->subName = '';
       $upload->rootPath = "./Uploads/file/";              
       $images = $upload->upload();
        //判断是否有图
        if ($images) {
               $info = $images['fileName']['savepath'] . $images['fileName']['savename'];
		  $data['fileName'] = $info;   
		  $data['url'] = '/Uploads/file/'.$info;    
	 	  $res = M('file')->add($data);
       	 if($res){
           	 	$this->success('上传成功!','/index.php?m=admin&c=file&a=fileList','3');
         	 }else{
            		return show(0,'添加失败');
      	 	 }                
        } else {
            $this->error($upload->getError());//获取失败信息
        }
        
    }


    //文件删除
    public function fileDel()
    {
        $maps['id'] = $_POST['id'];
        $fileInfo = M('file')->where($maps)->find();
	   $name = '.'.$fileInfo ['url'];
	   $name=iconv("UTF-8","gbk",$name);
	   if (unlink($name)) {
            if (M('file')->where($maps)->delete()) {
                return show(1, 'success');
            } else {
                return show(0, 'failed');
            }
        } else {
            return show(0, '删除文件夹里的文件失败');
        }
      
    }

    //文件下载
    public function fileDown(){
        if(IS_GET){
            $id=$_GET['id'];  //获取ID
            $map['id'] = $id;
            $res=M('file')->where($map)->find();
            $name=str_replace(' ','-',$res['filename']); //下载文件的名称(中间不能留空)
		$name=iconv("UTF-8","gbk",$name);
            if( !$res ){
                header("Content-type: text/html; charset=utf-8");
                echo "
              <html>
                <div>
                    <script>
                    alert('" . $name . "\\n文件损坏!');
                    window.history.go(-1);  //返回上一页
                     </script>
                </div>
              </html>";
            }else{
               //打开文件    
			 $file_dir = './Uploads/file/';
           		 $file = fopen ( $file_dir . $name, "r" );    
           		 //输入文件标签     
           		 Header ( "Content-type: application/octet-stream;CHARSET=utf-8" );    
           		 Header ( "Accept-Ranges: bytes" );    
            		 Header ( "Accept-Length: " . filesize( $file_dir . $name ) );    
           		 Header ( "Content-Disposition: attachment; filename=".$name);    
            		 //输出文件内容     
           		 //读取文件内容并直接输出到浏览器    
           		 echo fread ($file, filesize( $file_dir . $name ) );    
           		 fclose ($file);    
           		 exit ();    
			
		    }
        }else{
            return '文件不存在!';
        }

    }
}