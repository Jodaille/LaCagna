--
-- Insert navigation entries
-- route is the key of the route in module.config.php
--

INSERT INTO `menu` (`id`, `label`, `route`, `displayorder`, `role`) VALUES
(1, 'BO', 'adminindex', 50, 4),
(2, 'Produits', 'adminproductslist', 10, 4),
(3, 'Catégories', 'admincategorieslist', 15, 4);
