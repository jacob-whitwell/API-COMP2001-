using System;
using System.Data;
using Microsoft.Data.SqlClient;
using Microsoft.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore.Metadata;
using Microsoft.Extensions.Configuration;

#nullable disable

namespace API.Models
{
    public partial class COMP2001_JWhitwellContext : DbContext
    {
        private readonly string _connection;

        public COMP2001_JWhitwellContext()
        {
        }

        
        public COMP2001_JWhitwellContext(DbContextOptions<COMP2001_JWhitwellContext> options)
            : base(options)
        {
            _connection = Database.GetConnectionString();
        }


        public virtual DbSet<Programme> Programmes { get; set; }

        protected override void OnConfiguring(DbContextOptionsBuilder optionsBuilder)
        {
            /*if (!optionsBuilder.IsConfigured)
            {
#warning To protect potentially sensitive information in your connection string, you should move it out of source code. You can avoid scaffolding the connection string by using the Name= syntax to read it from configuration - see https://go.microsoft.com/fwlink/?linkid=2131148. For more guidance on storing connection strings, see http://go.microsoft.com/fwlink/?LinkId=723263.
                optionsBuilder.UseSqlServer("Server=socem1.uopnet.plymouth.ac.uk; Database = COMP2001_JWhitwell; User ID = JWhitwell; Password = SaeW186*");
            }*/
        }

        protected override void OnModelCreating(ModelBuilder modelBuilder)
        {
            //modelBuilder.Entity<Programme>().Ignore(e => e.ResponseMessage);


            modelBuilder.HasAnnotation("Relational:Collation", "Latin1_General_CI_AS");
            modelBuilder.Entity<Programme>(entity =>
            {
                entity.HasKey(e => e.ProgrammeCode)
                    .HasName("pk_programme_ProgrammeCode");

                entity.ToTable("Programmes", "CW2");

                entity.Property(e => e.ProgrammeCode).ValueGeneratedNever();

                entity.Property(e => e.Description)
                    .HasMaxLength(255)
                    .IsUnicode(false);

                entity.Property(e => e.Title)
                    .IsRequired()
                    .HasMaxLength(50)
                    .IsUnicode(false);
            });


            OnModelCreatingPartial(modelBuilder);
        }

        partial void OnModelCreatingPartial(ModelBuilder modelBuilder);

        public void Create_Programme(Programme programme, out string responseMessage)
        {
            // Get the connection
            using (SqlConnection sql = new SqlConnection(_connection))
            {
                // Use the Create_Programme Stored Procedure
                using (SqlCommand cmd = new SqlCommand("CW2.Create_Programme", sql))
                {

                    cmd.CommandType = CommandType.StoredProcedure;
                    cmd.Parameters.Add(new SqlParameter("@ProgrammeCode", programme.ProgrammeCode));
                    cmd.Parameters.Add(new SqlParameter("@Title", programme.Title));
                    cmd.Parameters.Add(new SqlParameter("@Description", programme.Description));

                    // Add the ResponseMessage parameter
                    SqlParameter output = new SqlParameter("@ResponseMessage", SqlDbType.NVarChar, 255);
                    output.Direction = ParameterDirection.Output;
                    cmd.Parameters.Add(output);


                    sql.Open();
                    cmd.ExecuteNonQuery();

                    // Save the responseMessage to use in the Controller
                    responseMessage = output.Value.ToString();
                }

            }
        }


        public void Update_Programme(short id, Programme programme)
        {
            // Get the connection
            using (SqlConnection sql = new SqlConnection(_connection))
            {
                using (SqlCommand cmd = new SqlCommand("CW2.Update_Programme", sql))
                {
                    cmd.CommandType = CommandType.StoredProcedure;

                    // Check if it is null, because we don't have to update everything.
                    cmd.Parameters.Add(new SqlParameter("@ProgrammeCode", id));
                    cmd.Parameters.Add(new SqlParameter("@Title", string.IsNullOrEmpty(programme.Title) ? (object)DBNull.Value : programme.Title));
                    cmd.Parameters.Add(new SqlParameter("@Description", string.IsNullOrEmpty(programme.Description) ? (object)DBNull.Value : programme.Description));


                    sql.Open();

                    cmd.ExecuteNonQuery();
                }
            }
        }

        public void Delete_Programme(short id, Programme programme)
        {
            using (SqlConnection sql = new SqlConnection(_connection))
            {
                using (SqlCommand cmd = new SqlCommand("CW2.Delete_Programme", sql))
                {
                    cmd.CommandType = CommandType.StoredProcedure;
                    cmd.Parameters.Add(new SqlParameter("@ProgrammeCode", id));

                    sql.Open();

                    cmd.ExecuteNonQuery();
                }
            }
        }
    }
}
