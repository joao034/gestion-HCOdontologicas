CREATE TRIGGER `actualizar_total_presupuesto` AFTER INSERT ON `odontograma_detalle`
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

CREATE TRIGGER `restar_total_presupuesto` AFTER UPDATE ON `odontograma_detalle`
 FOR EACH ROW BEGIN
    -- variables
    DECLARE precio_tratamiento FLOAT;
        
    -- Verificar el estado antes de actualizar el total
    IF NEW.estado = 'fuera_presupuesto' THEN
        -- Obtener el precio del tratamiento
        SELECT precio INTO precio_tratamiento FROM tratamientos WHERE id = OLD.tratamiento_id;

        -- Actualizar el total en la tabla odontograma_cabecera
        UPDATE odontograma_cabecera
        SET total = total - precio_tratamiento
        WHERE id = OLD.odontograma_cabecera_id;
    END IF;
END

CREATE TRIGGER `restar_total_presupuesto_delete` AFTER DELETE ON `odontograma_detalle`
 FOR EACH ROW BEGIN
    -- variables
    DECLARE precio_tratamiento FLOAT;
    DECLARE estado_tratamiento VARCHAR(255);
        
        -- Obtener el precio y el estado del tratamiento
        SELECT precio INTO precio_tratamiento FROM tratamientos WHERE id = OLD.tratamiento_id;
        
        SELECT estado INTO estado_tratamiento FROM odontograma_detalle WHERE id = OLD.id;

        -- Actualizar el total en la tabla odontograma_cabecera
        
     IF estado_tratamiento = 'necesario' THEN   
        UPDATE odontograma_cabecera
        SET total = total - precio_tratamiento
        WHERE id = OLD.odontograma_cabecera_id;
     END IF;
END
