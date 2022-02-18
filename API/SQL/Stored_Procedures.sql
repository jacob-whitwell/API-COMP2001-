DROP PROCEDURE CW2.Create_Programme
GO
CREATE PROCEDURE CW2.Create_Programme (
    @ProgrammeCode AS SMALLINT,
    @Title AS VARCHAR(50),
    @Description AS VARCHAR(255),
    @responseMessage VARCHAR(255) OUTPUT
)
AS
BEGIN
    BEGIN TRANSACTION
        BEGIN TRY
            DECLARE @Error NVARCHAR(Max);
            DECLARE @ProgrammeExists SMALLINT; 

            -- Check whether the ProgrammeCode already exists in the table
            SELECT @ProgrammeExists = ProgrammeCode FROM CW2.Programmes
            WHERE ProgrammeCode = @ProgrammeCode

            -- If it doesn't exist, insert it
            IF @ProgrammeExists IS NULL
            BEGIN 
                INSERT INTO CW2.Programmes(ProgrammeCode, Title, [Description])
                VALUES(@ProgrammeCode, @Title, @Description)

                SET @ResponseMessage = '201'
            END
            ELSE 
                -- If it does exist, show an error
                SET @responseMessage = '208'
                SET @Error =  @Error + 'Call successful, but Programme already exists and so new entry not made:'

            
        IF @@TRANCOUNT > 0 COMMIT;
        END TRY
        BEGIN CATCH
            SET @responseMessage = '400'
            SET @Error = @error + 'An error was encountered and the Programme could not be created'
            IF @@TRANCOUNT > 0
                ROLLBACK TRANSACTION;
            RAISERROR(@Error, 1, 0);
        END CATCH   
END;


DROP PROCEDURE CW2.Update_Programme
GO
CREATE PROCEDURE CW2.Update_Programme (
    @ProgrammeCode AS SMALLINT,
    -- This needs to be after the responseMessage, so that we can choose whether to use it or not
    @Title AS VARCHAR(50) = 'default',
    @Description AS VARCHAR(255) = 'default',
    @responseMessage VARCHAR(255) OUTPUT
)
AS
BEGIN
    BEGIN TRANSACTION
        BEGIN TRY
            DECLARE @Error NVARCHAR(MAX);
            DECLARE @ProgrammeExists SMALLINT;   

            -- Check whether the programme exists in the table
            SELECT @ProgrammeExists = ProgrammeCode FROM CW2.Programmes
            WHERE ProgrammeCode = @ProgrammeCode

            -- If it does exist, update it
            IF @ProgrammeExists IS NOT NULL
            BEGIN 
                -- If the default has been changed, then change the record
                IF @Title != 'default'
                BEGIN
                    IF @Description != 'default'
                    BEGIN   
                        UPDATE CW2.Programmes
                        SET Title = @Title, [Description] = @Description
                        WHERE ProgrammeCode = @ProgrammeCode
                    END
                    ELSE 
                        UPDATE CW2.Programmes
                        SET Title = @Title
                        WHERE PRogrammeCode = @ProgrammeCode
                    END
                SET @responseMessage = '204'
            END

            IF @@TRANCOUNT > 0 COMMIT;
        END TRY
        BEGIN CATCH
            SET @Error = 'Not Found'
            SET @responseMessage = '404'
            SELECT @Error
            IF @@TRANCOUNT > 0
                ROLLBACK TRANSACTION;
            RAISERROR(@Error, 1, 0);
        END CATCH
END;


dROP PROCEDURE CW2.Delete_Programme
GO
CREATE PROCEDURE CW2.Delete_Programme(
    @ProgrammeCode AS SMALLINT,
    @responseMessage VARCHAR(255) OUTPUT
)
AS
BEGIN 
    BEGIN TRANSACTION
        BEGIN TRY
            DECLARE @Error NVARCHAR(MAX);
            DECLARE @ProgrammeExists SMALLINT;

            
            -- If it does exist, delete it
            SELECT @ProgrammeExists = ProgrammeCode FROM CW2.Programmes
            WHERE ProgrammeCode = @ProgrammeCode

            IF @ProgrammeExists IS NOT NULL
            BEGIN
                DELETE FROM CW2.StudentProgramme
                WHERE ProgrammeCode = @ProgrammeCode

                DELETE FROM CW2.ProgrammeProjects
                WHERE ProgrammeCode = @ProgrammeCode

                DELETE FROM CW2.Programmes
                WHERE ProgrammeCode = @ProgrammeCode

                
                SET @responseMessage = '204'
            END

        IF @@TRANCOUNT > 0 COMMIT;
        END TRY
        BEGIN CATCH
            SET @Error = CONCAT(@Error, 'Error deleting programme')
            SET @responseMessage = '404'
            IF @@TRANCOUNT > 0
                ROLLBACK TRANSACTION;
            RAISERROR(@Error, 1, 0);
        END CATCH
END;
     
