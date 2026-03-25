-- Add the new column (defaulting to a standard 'User')
ALTER TABLE utilizadores 
ADD COLUMN perfil VARCHAR(20) NOT NULL DEFAULT 'User' AFTER email;

-- Promote your existing admin account
UPDATE utilizadores 
SET perfil = 'Admin' 
WHERE email = 'admin@hospital.pt';