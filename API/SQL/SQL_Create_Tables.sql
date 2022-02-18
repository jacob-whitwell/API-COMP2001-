create schema CW2
GO

DROP TABLE CW2.Programmes
DROP TABLE CW2.Projects
DROP TABLE CW2.Audit
DROP TABLE CW2.Students
DROP TABLE CW2.StudentProgramme 
DROP TABLE CW2.StudentProjects
DROP TABLE CW2.ProgrammeProjects


CREATE TABLE CW2.Programmes (
    ProgrammeCode SMALLINT NOT NULL,
    Title VARCHAR(50) NOT NULL,
    [Description] VARCHAR(255) NOT NULL,

    CONSTRAINT pk_programme_ProgrammeCode PRIMARY KEY (ProgrammeCode)
)


CREATE TABLE CW2.Students (
    StudentID INT IDENTITY(1, 1),
    Fname VARCHAR(30) NOT NULL,
    LName VARCHAR(30) NOT NULL,

    CONSTRAINT pk_studentID PRIMARY KEY (StudentID)
)


CREATE TABLE CW2.Projects (
    ProjectID INT identity(1, 1),
    Title VARCHAR(30) NOT NULL,
    [Description] VARCHAR(255) NOT NULL,
    Year INT NOT NULL,
    Thumbnail varbinary(max),
    Poster varbinary(max),

    CONSTRAINT pk_projectID PRIMARY KEY (ProjectID),
)


--DROP TABLE CW2.StudentProgramme
CREATE TABLE CW2.StudentProgramme (
    -- This is a compound key, because they are keys from different tables.
    StudentID INT NOT NULL FOREIGN KEY REFERENCES CW2.Students(StudentID),
    ProgrammeCode SMALLINT NOT NULL FOREIGN KEY REFERENCES CW2.Programmes(ProgrammeCode)
)

CREATE TABLE CW2.StudentProjects (
    StudentID INT NOT NULL FOREIGN KEY REFERENCES CW2.Students(StudentID),
    ProjectID INT NOT NULL FOREIGN KEY REFERENCES CW2.Projects(ProjectID)
)

CREATE TABLE CW2.ProgrammeProjects (
    ProgrammeCode SMALLINT NOT NULL FOREIGN KEY REFERENCES CW2.Programmes(ProgrammeCode),
    ProjectID INT NOT NULL FOREIGN KEY REFERENCES CW2.Projects(ProjectID)
)


--DROP TABLE CW2.Audit
CREATE TABLE CW2.Audit (
    AuditID INT IDENTITY(1, 1),
    ProgrammeCode SMALLINT NOT NULL,
    Title VARCHAR(50) NOT NULL,
    [Description] VARCHAR(255) NOT NULL,
    DateChanged DATETIME NOT NULL,

    CONSTRAINT pk_auditID PRIMARY KEY (AuditID)
)

