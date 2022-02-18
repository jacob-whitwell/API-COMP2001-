DROP TRIGGER CW2.ProgrammeAudit

-- One trigger is to be created that on updating a programme the old programme details are saved
-- into an audit table. This audit table will not be exposed by the API but is to be put into place for
-- future work.
GO
CREATE TRIGGER CW2.ProgrammeAudit ON CW2.Programmes
AFTER INSERT, UPDATE, DELETE
AS
BEGIN

    IF UPDATE(Title)
    BEGIN
        insert into cw2.Audit (ProgrammeCode, Title, [Description], DateChanged)
        SELECT ProgrammeCode, Title, [Description], GETDATE()
        FROM deleted
    END
    
    IF UPDATE([Description])
    BEGIN
        insert into cw2.Audit (ProgrammeCode, Title, [Description], DateChanged)
        SELECT ProgrammeCode, Title, [Description], GETDATE()
        FROM deleted
    END
END


ALTER TABLE CW2.Programmes
ENABLE TRIGGER [ProgrammeAudit]





