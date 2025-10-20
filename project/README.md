# YeniePin Platform İskeleti

Bu depo, E-PIN ve dijital lisans satış sistemi için MVC benzeri bir iskelet içerir. `project/public/index.php` dosyası giriş noktasıdır ve rota yönlendirmesi için çekirdek Router sınıfına delegasyon yapar.

## Klasör Yapısı

- `app/` – Uygulamaya ait controller, model, view ve middleware sınıfları
- `core/` – Router, Bootstrap ve yardımcı çekirdek bileşenler
- `config/` – Konfigürasyon dosyaları (uygulama, veritabanı, rota, mail)
- `public/` – Web sunucusunun kök dizini ve ön uç varlıkları
- `storage/` – Log, cache ve yükleme dosyaları
- `database/` – Şema ve örnek veri SQL dosyaları

## Başlangıç

```bash
cp project/.env.example.php project/.env.php
php -S localhost:8000 -t project/public
```

Sunucu çalıştırıldığında, tüm HTTP istekleri `index.php` aracılığıyla Router bileşenine iletilir.
