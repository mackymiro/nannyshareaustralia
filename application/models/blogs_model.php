<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Author: magento cebu <hello@magentocebu.com>
 * http://www.magentocebu.com
 * Cebu's more than just ideas
*/
class Blogs_model extends CI_Model{
	//delete from blogs
  public function deleteId($id){
		$this->db->where('tbl_blogs.id', $id)->delete('tbl_blogs');
  }

	//get Blogs for delete
	public function getBlogsToBeDeleted($id){
		 return $this->db->select(
                'tbl_blogs.id,
                 tbl_blogs.title,
                 tbl_blogs.content
                '
                )
            ->from('tbl_blogs')
            ->where('tbl_blogs.id', $id)
            ->get()->result_object();
     $this->db->get('tbl_blogs');
	}
	
	//get blog view id
	public function getBlogView($id){
		 return $this->db->get_where('tbl_blogs', array('id'=> $id))->result_object();
	}


	//get blog id
	public function getBlogId($id){
		 return $this->db->get_where('tbl_blogs', array('id'=> $id))->row_object();
	}

	//get blog details slug
	public function getBlogDetails($slug){
		 return $this->db->get_where('tbl_blogs', array('slug'=> $slug))->result_object();
	}
	
	//get blog posts limit to 3
	 public function getAllBlogPostsLimit(){
     return $this->db->select('
									tbl_blogs.id,
                  tbl_blogs.title,
                  tbl_blogs.image,
                  tbl_blogs.content,
									tbl_blogs.slug,
                  tbl_blogs.date
                  ')
                ->from('tbl_blogs')
								->limit(3)
                ->order_by('date', 'desc')
               ->get()->result_object();
   }

	//get all blogs posts to page
   public function getAllBlogPosts(){
     return $this->db->select('
									tbl_blogs.id,
                  tbl_blogs.title,
                  tbl_blogs.image,
                  tbl_blogs.content,
									tbl_blogs.slug,
                  tbl_blogs.date
                  ')
                ->from('tbl_blogs')
                ->order_by('date', 'desc')
               ->get()->result_object();
   }  

		//save to blogs 
		public function saveBlogs($data){
			$this->db->insert('tbl_blogs', $data);
		}
}
