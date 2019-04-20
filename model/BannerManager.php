<?php 
namespace App\model;
use App\entity\Banner;
use \PDO;

class BannerManager extends Manager {
    
    public function getBanners() {
        $db = $this->MySQLConnect();
        $req = $db->query('SELECT id, display_order, title, caption, image, button_title, button_link, 
        DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date, DATE_FORMAT(modification_date, \'%d/%m/%Y à %Hh%i\') AS modification_date 
        FROM banners ORDER BY display_order LIMIT 5'); 
    
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'App\entity\Banner');

        $banners = $req->fetchAll();

        return $banners;
    }

    public function getBanner($banner_id) {
        $db = $this->MySQLConnect();
        $req = $db->prepare('SELECT id, display_order, title, caption, image, button_title, button_link, 
        DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date, DATE_FORMAT(modification_date, \'%d/%m/%Y à %Hh%i\') AS modification_date 
        FROM banners WHERE id = ?');
        $req->execute(array($banner_id));
    
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'App\entity\Banner');

        $banner = $req->fetch();

        return $banner;
    }

    public function createBanner(Banner $banner) {
        $db = $this->MySQLConnect();
        $req = $db->prepare('INSERT INTO banners(display_order, title, caption, image, button_title, button_link, creation_date, modification_date)
        VALUES (:display_order, :title, :caption, :image, :button_title, :button_link, NOW(), NOW())');

        $affected_lines = $req->execute(array(
            'display_order' => $banner->displayOrder(),
            'title' => $banner->title(),
            'caption' => $banner->caption(),
            'image' => $banner->image(),
            'button_title' => $banner->buttonTitle(), 
            'button_link' => $banner->buttonLink()
        ));

        return $affected_lines;
    }

    public function editBanner(Banner $banner) {
        $db = $this->MySQLConnect();

        if (empty($banner->image())) {
            $req= $db->prepare('UPDATE banners SET title = :title, caption = :caption, button_title = :button_title, button_link = :button_link, modification_date = NOW()
            WHERE id = :id');

            $affected_lines =  $req->execute(array(
                'title' => $banner->title(),
                'caption' => $banner->caption(),
                'button_title' => $banner->buttonTitle(), 
                'button_link' => $banner->buttonLink(),
                'id' => $banner->id()
            ));
        } else {
            $req= $db->prepare('UPDATE banners SET title = :title, caption = :caption, button_title = :button_title, button_link = :button_link, image = :image, modification_date = NOW()
            WHERE id = :id');

            $affected_lines =  $req->execute(array(
                'title' => $banner->title(),
                'caption' => $banner->caption(),
                'button_title' => $banner->buttonTitle(), 
                'button_link' => $banner->buttonLink(),
                'image' => $banner->image(),
                'id' => $banner->id()
            ));
        }
        
        return $affected_lines;
    }
    
    public function deleteBanner($banner_id) {
        
        $db = $this->MySQLConnect();
        $req = $db->prepare('DELETE FROM banners WHERE id = ?');
        
        $affected_lines = $req->execute(array($banner_id));

        return $affected_lines;
    }

}