CREATE TABLE IF NOT EXISTS  task  (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS  user  (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(319) NOT NULL,  -- 64 + 1 + 255,
    user_name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    type ENUM('admin', 'user') DEFAULT 'user',
    validated BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO  user  (email, user_name, password, type, validated) VALUES
    ('admin@localhost', 'admin', 'admin', 'admin', TRUE);