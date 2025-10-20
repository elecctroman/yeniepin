-- UTF-8 encoding
SET NAMES utf8mb4;

INSERT INTO users (email, password_hash, name, phone, role, status, twofa_enabled)
VALUES
('admin@yeniepin.local', '$2y$10$C9l7CWy3Y0mS5HnHt6YUpu2eTbx4H81acVu2cU7V0w.zF4DxP52sG', 'Yönetici', '+905551112233', 'admin', 'active', 1),
('musteri@yeniepin.local', '$2y$10$mq2f3sX0mPkGJMwV1puGJuDptip0lG.9foRPPxFoCAW1ScTcAfwd2', 'Demo Müşteri', '+905554445566', 'customer', 'active', 0);

INSERT INTO categories (name, slug, parent_id, position, hidden) VALUES
('Oyun Kodları', 'oyun-kodlari', NULL, 1, 0),
('Yazılım Lisansları', 'yazilim-lisanslari', NULL, 2, 0),
('Premium Hesaplar', 'premium-hesaplar', NULL, 3, 0);

INSERT INTO products (category_id, type, name, slug, description, price, tax_rate, stock_policy, delivery, min_qty, max_qty, status)
VALUES
(1, 'epin', '100 TL Oyun E-PIN', '100-tl-oyun-epin', 'Anında teslim edilen 100 TL değerinde oyun kodu.', 100.00, 18.00, 'track', 'instant', 1, 5, 'active'),
(2, 'license', 'Pro Yazılım Lisansı', 'pro-yazilim-lisansi', '1 yıllık profesyonel lisans anahtarı.', 299.00, 18.00, 'track', 'instant', 1, 3, 'active'),
(3, 'account', 'Premium Streaming Hesabı', 'premium-streaming-hesabi', '30 gün kullanım süresi ile premium hesap.', 149.00, 18.00, 'track', 'manual', 1, 2, 'active');

INSERT INTO product_variants (product_id, name, price_override, stock_override) VALUES
(2, 'Tek Kullanıcı', NULL, NULL),
(2, '3 Kullanıcı', 749.00, NULL);

INSERT INTO epin_keys (product_id, code, batch_id, status)
VALUES
(1, 'EPIN-100-AAA111', 'BATCH-202401', 'available'),
(1, 'EPIN-100-BBB222', 'BATCH-202401', 'available'),
(1, 'EPIN-100-CCC333', 'BATCH-202401', 'available');

INSERT INTO accounts (product_id, username, password_encrypted, extra_json, status)
VALUES
(3, 'premium_user_1', UNHEX('70617373776F7264313233'), JSON_OBJECT('note', 'Teslimattan sonra şifreyi değiştiriniz.'), 'available'),
(3, 'premium_user_2', UNHEX('70617373776F7264343536'), JSON_OBJECT('note', '30 gün geçerlidir.'), 'available');

INSERT INTO coupons (code, type, value, max_uses, used_count, starts_at, ends_at, min_cart_total, active) VALUES
('HOSGELDIN10', 'percent', 10.00, 100, 0, NOW(), DATE_ADD(NOW(), INTERVAL 6 MONTH), 100.00, 1),
('EKIM50', 'fixed', 50.00, 50, 0, NOW(), DATE_ADD(NOW(), INTERVAL 3 MONTH), 200.00, 1);

INSERT INTO wallets (customer_id, balance)
VALUES
(2, 150.00);

INSERT INTO wallet_tx (wallet_id, type, amount, reason, ref_id)
VALUES
(1, 'credit', 150.00, 'Başlangıç bakiyesi', 'SEED-INIT');
