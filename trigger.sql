DELIMITER $$
CREATE OR REPLACE TRIGGER `sumar_total_presupuesto` AFTER INSERT ON `odontograma_detalle`
 FOR EACH ROW BEGIN
    -- variables
    DECLARE precio_tratamiento FLOAT;
        
    -- Verificar el estado antes de actualizar el total
    IF NEW.estado = 'necesario' OR NEW.estado = 'presupuesto' THEN
        -- Obtener el precio del tratamiento
        SELECT precio INTO precio_tratamiento FROM tratamientos WHERE id = NEW.tratamiento_id;

        -- Actualizar el total en la tabla odontograma_cabecera
        UPDATE odontograma_cabecera
        SET total = total + precio_tratamiento
        WHERE id = NEW.odontograma_cabecera_id;
    END IF;
END
$$



DELIMITER $$
CREATE OR REPLACE TRIGGER `restar_total_presupuesto_delete` AFTER DELETE ON `odontograma_detalle`
 FOR EACH ROW BEGIN

     IF OLD.estado = 'necesario' THEN   
        -- Actualizar el total en la tabla odontograma_cabecera
        UPDATE odontograma_cabecera
        SET total = total - OLD.precio
        WHERE id = OLD.odontograma_cabecera_id;
     END IF;
END
$$

DELIMITER $$
CREATE OR REPLACE TRIGGER `crear_odontograma` AFTER INSERT ON `pacientes`
 FOR EACH ROW BEGIN
    INSERT INTO `odontograma_cabecera` (fecha_creacion, total, paciente_id, created_at, updated_at) VALUES (NOW(), 0, NEW.id, NOW(), NOW());
END
$$

//eliminar un TRIGGER
DROP TRIGGER IF EXISTS `crear_odontograma`;

