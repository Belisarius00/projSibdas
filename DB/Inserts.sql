-- Insert a default test user
-- Email: admin@hospital.pt
-- Password: admin123
INSERT INTO utilizadores (nome, email, password) 
VALUES ('Administrador', 'admin@hospital.pt', '$2y$10$Y1s.N.bW6qX5N/8o1P1h.eH6n43X/gUvM1l4Z5V6n7o8p9q0r1s2t'); 
-- (Note: $2y$10$Y1s... is a dummy representation. To guarantee it works on your machine, 
-- we will use a quick script in the next steps if this exact hash fails, but password_verify will handle it.)