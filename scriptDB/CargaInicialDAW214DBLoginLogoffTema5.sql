/**
 * Author:  Carlos García Cachón
 * Created: 28 nov 2023
 */
-- Inserto los datos iniciales en la tabla T02_Departamento
INSERT INTO DB214DWESLoginLogoffTema5.T02_Departamento (T02_CodDepartamento, T02_DescDepartamento, T02_FechaCreacionDepartamento, T02_VolumenDeNegocio, T02_FechaBajaDepartamento) VALUES
    ('AAA', 'Departamento de Ventas', NOW(), 100000.50, NULL),
    ('AAB', 'Departamento de Marketing', NOW(), 50089.50, NULL),
    ('AAC', 'Departamento de Finanzas', NOW(), 600.50, '2023-11-13 13:06:00'),
    ('AAD', 'Departamento de Administracion', NOW(), 100000.50, NULL),
    ('AAE', 'Departamento de I+D', NOW(), 50089.50, NULL),
    ('AAF', 'Departamento de Inversiones', NOW(), 100000.50, NULL),
    ('AAG', 'Departamento de Recursos Humanos', NOW(), 50089.50, NULL),
    ('AAH', 'Departamento de Calidad', NOW(), 80000.40, NULL),
    ('AAI', 'Departamento de Soporte', NOW(), 95000.70, NULL),
    ('AAJ', 'Departamento de Tecnología', NOW(), 115000.45, NULL),
    ('AAK', 'Departamento de Desarrollo', NOW(), 90000.55, NULL),
    ('AAL', 'Departamento de Comunicaciones', NOW(), 75000.25, NULL),
    ('AAM', 'Departamento de Legal', NOW(), 110000.60, NULL),
    ('AAN', 'Departamento de Investigación', NOW(), 85000.80, NULL),
    ('AAO', 'Departamento de Planificación', NOW(), 90000.40, NULL),
    ('AAP', 'Departamento de Auditoría', NOW(), 130000.20, NULL);

-- Inserto los datos iniciales en la tabla T01_Usuario con contraseñas cifradas en SHA-256
INSERT INTO DB214DWESLoginLogoffTema5.T01_Usuario (T01_CodUsuario, T01_Password, T01_DescUsuario, T01_Perfil) VALUES
    ('admin', SHA2('adminpaso', 256), 'administrador', 'administrador'),
    ('alvaro', SHA2('alvaropaso', 256), 'Álvaro Cordero Miñambres', 'usuario'),
    ('carlos', SHA2('carlospaso', 256), 'Carlos García Cachón', 'usuario'),
    ('oscar', SHA2('oscarpaso', 256), 'Oscar Pascual Ferrero', 'usuario'),
    ('borja', SHA2('borjapaso', 256), 'Borja Nuñez Refoyo', 'usuario'),
    ('rebeca', SHA2('rebecapaso', 256), 'Rebeca Sánchez Pérez', 'usuario'),
    ('erika', SHA2('erikapaso', 256), 'Erika Martínez Pérez', 'usuario'),
    ('ismael', SHA2('ismaelpaso', 256), 'Ismael Ferreras García', 'usuario'),
    ('heraclio', SHA2('heracliopaso', 256), 'Heraclio Borbujo Moran', 'usuario'),
    ('amor', SHA2('amorpaso', 256), 'Amor Rodriguez Navarro', 'usuario');

-- Inserto los datos iniciales en la tabla T06_Animales
INSERT INTO DB214DWESLoginLogoffTema5.T06_Animales (T06_CodAnimal, T06_DescAnimal, T06_FechaNacimiento, T06_Sexo, T06_Raza, T06_Precio, T06_FechaBaja) VALUES
    ('001', 'Vaca', '2023-01-15 10:30:00', 'hembra', 'Holstein', 1200.50, NULL),
    ('002', 'Cerdo', '2022-08-05 15:45:00', 'macho', 'Large Black', 800.75, NULL),
    ('003', 'Gallina', '2021-05-20 08:00:00', 'hembra', 'Rhode Island Red', 25.99, NULL),
    ('004', 'Cabra', '2023-03-12 12:15:00', 'hembra', 'Saanen', 500.00, '2023-11-01 14:20:00'),
    ('005', 'Caballo', '2022-11-30 18:30:00', 'macho', 'Thoroughbred', 2500.25, NULL),
    ('006', 'Oveja', '2022-02-28 09:45:00', 'hembra', 'Dorset Horn', 700.99, NULL),
    ('007', 'Pato', '2022-07-10 16:00:00', 'macho', 'Pekin', 35.50, NULL),
    ('008', 'Burro', '2021-12-05 11:20:00', 'macho', 'Miniature', 1200.00, NULL),
    ('009', 'Conejo', '2023-04-18 14:00:00', 'macho', 'Holland Lop', 50.00, NULL),
    ('010', 'Perro', '2022-09-22 20:10:00', 'macho', 'Golden Retriever', 1200.00, NULL);