using System;
using System.Collections.Generic;

#nullable disable

namespace API.Models
{
    public partial class Programme
    {
        public short ProgrammeCode { get; set; }
        public string Title { get; set; }
        public string Description { get; set; }

        //public string ResponseMessage { get; set; }
        // I needed to remove this because it was either stopping my GET, or stopping my PUT.
        // Instead, I will add the paramter into the SqlQuery in the Context class
    }
}
