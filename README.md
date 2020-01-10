# portal-main

Bu modül online alışveriş sayfasının ana ekranı olarak tasarlanmıştır. Herhangi bir kullanıcı satılan ürünleri görebildiği halde satın alma yapamaz. Satın alma yetkisine sahip olan üye alışveriş tutarını işlem tamamlandıktan sonra flash mesaj aracılığı ile görebilir. Her üyenin satın alma yetkisine sahip olmamasının nedeni üyelik oluşturma aşamasında satın alma yapabilcek kadar bilgi istenmemesi, kullanıcıların üye oymalarını zorlaştırmamak için. Bunun önüne yetkilendirmelerle geçiliyor. Backend kısmında yönetici yeni bir ürün ekleyebilir, varolan bir kaydı güncelleyebilir veya satılan ürünleri, adetleri ve fiyatları ile görebilir. Backend kısmına erişebilen herhangi biri yeni ürün kaydı oluşturamaz, bunun da önüne yetkilendirme ile geçildi.

## Modülün kullanımı
### Kurulum 
[https://github.com/kouosl/portal](https://github.com/kouosl/portal) adresindeki yönlendirmeler doğrultusunda sanal makine kurulur. portal/vendor/kouosl/portal-main adresine bu depodan indirilen dosyalar eklenir. \frontend\config\main.php ve \backend\config\main.php dosyalarına aşağıdaki kod eklenir.
```php
'modules' => [ 
		'main' => [ 
				'class' => 'kousol\main\Module',
				 ],
		 ],
```
Son olarak modül'ün bulunduğu github deposu composer.json'da tanıtıldıktan sonra modül kullanıma hazırlanmış olur.
### Packagist
Modül [https://packagist.org/packages/main-module/portal-main](https://packagist.org/packages/main-module/portal-main) adresinde paket olarak tanımlandı. 
```php
composer require main-module/portal-main
```
 kodu ile de indirilebilir. 
Not: Vendor klasörü kouosl tarafından kullanıldığı için main-module klasörüne atılacak.
Modül indirildikten sonra eğer kurulum [https://github.com/kouosl/portal](https://github.com/kouosl/portal)  adresinden yapılmadıysa gerekli paketlerin yüklenmesi için aşağıdaki kod çalıştırılmalıdır.
```
vagrant ssh
cd /var/www/portal
composer update

```


### Migration'larla tabloların oluşturulması ve kayıt eklenmesi
Modülün kullanılabilmesi için gerekli tabloların oluşturulması ve örnek kayıtların girilmesi için aşağıdaki kodlar çalıştırılmalıdır.
```
vagrant ssh
php yii migrate --migrationPath=/var/www/portal/vendor/kouosl/portal-main/migrations
```

### Frontend
Frontend kısmında checkbox'larla seçilen ürünler, eğer yeterli şartlar sağlanıyorsa buy butonuna tıklanarak satın alınabilir. Butona tıklamanın 'actionBuy' fonk. çalışır, seçilen her ürün için 'product' tablosunda stoklar güncellenir ve satılan ürünlerin tutulduğu 'sold_products' tablosuna ekleme yapılır.

Frontend'e 'portal.kouosl/main' adresinden erişilebilir.

![enter image description here](https://github.com/2019-BLM317/portal-170202001/blob/master/imgs/al%C4%B1%C5%9Fveri%C5%9F-1.bmp)

Satın alma tamamlandıysa alışveriş tutarı **flash mesajla** kullanıcıya bildirilir.
```
$message = "Successful. Shopping amount is $cost pounds";

Yii::$app->session->setFlash('buy', $message);
```

![enter image description here](https://github.com/2019-BLM317/portal-170202001/blob/master/imgs/sat%C4%B1n%20alma%20tamam.bmp)

### Backend
portal.kouosl/admin/main adresinde varolan ürün kayıtlarını görebilir, 'create new product' butonu ile eğer izniniz varsa yeni kayıt oluşturabilir veya 'Show sold products' butonu ile satılan ürünlerin kaydını görebilirsiniz.

##### Backend-index
Backend-index'e 'portal.kouosl/main' adresinden erişilebilir.

![Backend ekranı](https://github.com/2019-BLM317/portal-170202001/blob/master/imgs/backend-1.jpg)

##### Backend-sold_products
Backend-index'e 'portal.kouosl/admin/main/default/sold' adresinden erişilebilir.

![enter image description here](https://github.com/2019-BLM317/portal-170202001/blob/master/imgs/backend-2.jpg)

### Dil Paketleri
Varolan tek dil paketi '/messages/tr-TR/main.php' dosyasıdır.
Dosyayı görmek için: [main.php]([https://github.com/2019-BLM317/portal-170202001/blob/master/messages/tr-TR/main.php](https://github.com/2019-BLM317/portal-170202001/blob/master/messages/tr-TR/main.php))


### RBAC
Migration kodlarının işletilmesiyle RBAC için gerekli tablolar, kurallar, ilişkilendirmeler ve yetki atamları tanımalanmış olur.
Kodların işletilmesiyle üç rule tanımlanıyor. admin(create-product'ın ve create-sold_products'ın parent'ıdır), create-product ve create -sold_products. Bu tanımlamalarla herhangi bir kullanıcının tablolara erişimi kısıtlanmış olur. 
Yeni ürün oluşturma create-product iznine tabidir ve migration'la id'si 1 olan kullanıcıya verilmiştir. 
Bir üyenin satın alma yapabilmesi için create-sold_products izni olan bir kullanıcı olması gerekir. 'sold_products' tablosunda satılan ürünler tutulduğundan tabloda değişiklik bir satın alma sonucu gerçekleşebilir.  Herhangi bir üyenin bu izne sahip olmamasının nedeni üye olmak için ödeme verilmesi şart olmadığındandır. Bir üye ödeme bilgilerini eksiksiz girdikten sonra 'create-sold_products' iznini alır ve alışveriş yapabilir(teorik olarak).

Örnek: Kullanıcı girişi yapıldığı halde create sayfasına erişilememesi.
Kontrol aşağıdaki kod bloğu ile sağlanıyor.
```
if(Yii::$app->user->can('create-product')){
	....
else{
	throw  new  ForbiddenHttpException;
}
```

![enter image description here](https://github.com/2019-BLM317/portal-170202001/blob/master/RBAC.JPG)

Satın alma öncesi ise aşağıdaki kod ile kontrol sağlanıyor.
```
if(Yii::$app->user->can('create-sold_products')){
	....
else{
	throw  new  ForbiddenHttpException;
}
```

