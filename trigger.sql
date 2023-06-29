DELIMITER //

CREATE TRIGGER actualizar_total_presupuesto
AFTER INSERT ON odontograma_detalle
FOR EACH ROW
BEGIN
    --variables
    DECLARE precio_tratamiento FLOAT;
        
    -- Verificar el estado antes de actualizar el total
    IF NEW.estado = 'necesario' THEN
        --Obtener el precio del tratamiento
        SELECT precio INTO precio_tratamiento FROM tratamientos WHERE id = NEW.tratamiento_id;

        -- Actualizar el total en la tabla odontograma_cabecera
        UPDATE odontograma_cabecera
        SET total = total + precio_tratamiento
        WHERE id = NEW.odontograma_cabecera_id;
    END IF;
END//

DELIMITER ;

DELIMITER //

CREATE OR UPDATE TRIGGER restar_total_presupuesto
AFTER DELETE ON odontograma_detalle
FOR EACH ROW
BEGIN
    -- variables
    DECLARE precio_tratamiento FLOAT;
        
    -- Verificar el estado antes de actualizar el total
    IF OLD.estado = 'necesario' THEN
        -- Obtener el precio del tratamiento
        SELECT precio INTO precio_tratamiento FROM tratamientos WHERE id = OLD.tratamiento_id;

        -- Actualizar el total en la tabla odontograma_cabecera
        UPDATE odontograma_cabecera
        SET total = total - precio_tratamiento
        WHERE id = OLD.odontograma_cabecera_id;
    END IF;
END//

DELIMITER ;

