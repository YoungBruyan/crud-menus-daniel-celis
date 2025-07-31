DROP TABLE IF EXISTS `menus`;
CREATE TABLE menus (
    id INT AUTO_INCREMENT PRIMARY KEY,
    menu_padre_id INT DEFAULT NULL,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(8,2),
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (menu_padre_id) REFERENCES menus(id) ON DELETE CASCADE
);

-- Nivel 0
INSERT INTO menus (nombre, descripcion, precio) VALUES
('Menú Principal', 'Raíz del menú', 0.00);

-- Nivel 1
INSERT INTO menus (menu_padre_id, nombre, descripcion, precio) VALUES
(1, 'Comida', 'Categoría de comida', 0.00),
(1, 'Bebidas', 'Categoría de bebidas', 0.00);

-- Nivel 2
INSERT INTO menus (menu_padre_id, nombre, descripcion, precio) VALUES
(2, 'Hamburguesas', 'Sección de hamburguesas', 0.00),
(2, 'Pizzas', 'Sección de pizzas', 0.00),
(3, 'Refrescos', 'Sodas frías', 0.00),
(3, 'Jugos', 'Jugos naturales', 0.00);

-- Nivel 3
INSERT INTO menus (menu_padre_id, nombre, descripcion, precio) VALUES
(4, 'Hamburguesa Clásica', 'Pan, carne y queso', 89.00),
(4, 'Hamburguesa Doble', 'Pan, doble carne y queso', 110.00),
(5, 'Pizza Pepperoni', 'Queso y pepperoni', 120.00),
(5, 'Pizza Hawaiana', 'Queso, jamón y piña', 125.00),
(6, 'Coca-Cola 600ml', 'Bebida fría', 22.00),
(7, 'Jugo de Naranja', 'Natural sin azúcar', 25.00);

-- Nivel 4
INSERT INTO menus (menu_padre_id, nombre, descripcion, precio) VALUES
(8, 'Tomate', 'Ingrediente para hamurgesa clasica', 0.00),
(8, 'Carne', 'Ingrediente para hamurgesa clasica', 0.00),
(8, 'Lechuga', 'Ingrediente para hamurgesa clasica', 0.00),
(8, 'Pan', 'Ingrediente para hamurgesa clasica', 0.00);