# portal-main

Bu modül online alışveriş sayfasının ana ekranı olarak tasarlanmıştır. Herhangi bir kullanıcı satılan ürünleri görebildiği halde satın alma yapamaz. Satın alma yetkisine sahip olan üye alışveriş tutarını işlem tamamlandıktan sonra flash mesaj aracılığı ile görebilir. Her üyenin satın alma yetkisine sahip olmamasının nedeni üyelik oluşturma aşamasında satın alma yapabilcek kadar bilgi istenmemesi, kullanıcıların üye oymalarını zorlaştırmamak için. Bunun önüne yetkilendirmelerle geçiliyor. Backend kısmında yönetici yeni bir ürün ekleyebilir, varolan bir kaydı güncelleyebilir veya satılan ürünleri, adetleri ve fiyatları ile görebilir. Backend kısmına erişebilen herhangi biri yeni ürün kaydı oluşturamaz, bunun da önüne yetkilendirme ile geçildi.


## Modülün kullanımı

### Frontend
Frontend kısmında checkbox'larla seçilen ürünler, eğer yeterli şartlar sağlanıyorsa buy butonuna tıklanarak satın alınabilir. Butona tıklamanın 'actionBuy' fonk. çalışır, seçilen her ürün için 'product' tablosunda stoklar güncellenir ve satılan ürünlerin tutulduğu 'sold_products' tablosuna ekleme yapılır.

![enter image description here](https://github.com/2019-BLM317/portal-170202001/blob/master/imgs/al%C4%B1%C5%9Fveri%C5%9F-1.bmp)

![enter image description here](https://github.com/2019-BLM317/portal-170202001/blob/master/imgs/sat%C4%B1n%20alma%20tamam.bmp)

### Backend
portal.kouosl/admin/main adresinde varolan ürün kayıtlarını görebilir, 'create new product' butonu ile eğer izniniz varsa yeni kayıt oluşturabilir veya 'Show sold products' butonu ile satılan ürünlerin kaydını görebilirsiniz.
##### Backend-index
![Backend ekranı](https://github.com/2019-BLM317/portal-170202001/blob/master/imgs/backend-1.jpg)
##### Backend-sold_products
![enter image description here](https://github.com/2019-BLM317/portal-170202001/blob/master/imgs/backend-2.jpg)


Satın alma yapabilmesi için create-sold_products izni olan bir kullanıcı olması gerekir. 'sold_products' tablosunda satılan ürünler tutulduğundan tabloda değişiklik bir satın alma sonucu gerçekleşebilir.  Yönetici backend'de Satabileceği, envanterinde olan ürünleri 'product' tablosuna ekleyebilir veya sattığı ürünlerin tutulduğu 'sold_products' tablosundaki kayıtları görebilir. Herhangi bir kullanıcının yeni bir kayıt eklemesinin önüne geçebilmek için RBAC 
