## test20201229
## 此版本使用Laravel 8
## ex:
	建立專案:composer create-project laravel/laravel project     
	建立model:php artisan make:model productlist -m
	建立、更新db:php artisan migrate
	建立controller AjaxController:php artisan make:controller AjaxController
	建立controller StorageFileController:php artisan make:controller StorageFileController
## 需創造一個table
	CREATE DATABASE `producttest` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

## 創造完後再cmmand line 上執行 php artisan migrate 更新你的資料庫
## 上面的cmmand line執行成功時底下是給予這個table 值
	INSERT INTO `productlists` (`id`, `product`, `oprice`, `sprice`, `Vendor`, `image`, `produce`, `add_time`) VALUES (NULL, 'a', '100', '10', 'C廠牌', 'a.jpg', '1111111111', '2020-12-29 00:00:00'), (NULL, 'b', '100', '10', 'A廠牌', 'b.jpg', '1111111111', '2020-12-28 00:00:00'), (NULL, 'c', '100', '50', 'B廠牌', 'c.jpg', '1111111111', '2020-12-24 00:00:00'), (NULL, 'd', '100', '20', 'C廠牌', 'e.jpg', '1111111111', '2020-12-18 00:00:00'), (NULL, 'e', '100', '30', 'A廠牌', 'f.jpg', '1111111111', '2020-12-13 00:00:00'), (NULL, 'f', '100', '20', 'B廠牌', 'g.jpg', '1111111111', '2020-12-17 00:00:00'), (NULL, 'g', '100', '100', 'C廠牌', 'h.jpg', '1111111111', '2020-12-24 00:00:00'), (NULL, 'h', '100', '90', 'B廠牌', 'i.jpg', '1111111111', '2020-12-22 00:00:00'), (NULL, 'i', '100', '50', 'A廠牌', 'j.jpg', '1111111111', '2020-12-25 00:00:00'), (NULL, 'j', '100', '30', 'B廠牌', 'h.jpg', '1111111111', '2020-12-23 00:00:00'), (NULL, 'k', '100', '20', 'C廠牌', 'l.jpg', '1111111111', '2020-12-27 00:00:00'), (NULL, 'l', '100', '50', 'C廠牌', 'm.jpg', '1111111111', '2020-12-25 00:00:00'), (NULL, 'm', '100', '50', 'B廠牌', 'n.jpg', '1111111111', '2020-12-14 00:00:00');
## 展示頁面路徑為
	http://[domain]/[你的project_name]/ajaxrequest