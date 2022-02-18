using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using Microsoft.Data.SqlClient;
using API.Models;

namespace API.Controllers
{
    [Route("[controller]")]
    [ApiController]
    public class ProgrammesController : ControllerBase
    {
        private readonly COMP2001_JWhitwellContext _database;

        public ProgrammesController(COMP2001_JWhitwellContext database)
        {
            _database = database;
        }

        // GET: api/Programmes
        [HttpGet]
        public async Task<ActionResult<IEnumerable<Programme>>> GetProgrammes()
        {
            return await _database.Programmes.ToListAsync();
        }

        // GET: /Programmes/{code}
        [HttpGet("{id}")]
        public async Task<ActionResult<Programme>> GetProgramme(short id)
        {
            var programme = await _database.Programmes.FindAsync(id);

            if (programme == null)
            {
                return NotFound();
            }

            return programme;
        }

        // PUT: /Programmes/{code}
        [HttpPut("{id}")]
        public IActionResult updateProgramme(short id, [FromBody] Programme programme)
        {

            try
            {
                _database.Update_Programme(id, programme);
                return StatusCode(204);
            }
            catch (Exception e)
            {
                return StatusCode(404);
            }

        }


        // POST: /Programmes/{NewID}
        [HttpPost]
        public IActionResult createProgramme([FromBody] Programme programme)
        {
            string responseMessage;
            int ResponseCode;

            createProgramme(programme, out responseMessage);


            if (responseMessage.Length > 0)
            {
                try
                {
                    ResponseCode = Convert.ToInt32(responseMessage);
                }
                catch (Exception e)
                {
                    return Ok(new string[] { "Error", e.ToString(), "ResponseMessage", responseMessage });
                }
            }
            else
            {
                // Placeholder statuscode to tell me there's an issue with the responseMessage. I love teapots.
                ResponseCode = 418;
            }

            switch (ResponseCode)
            {
                case 404: return BadRequest();
                    break;
                
                case 208: return StatusCode(208);
                    break;

                case 418:
                    return StatusCode(418);
                    break;

                default: return new JsonResult(new string[] { "ProgrammeID", responseMessage }) { StatusCode = StatusCodes.Status201Created };
            }
        }


        // In the YAML file, it says that both PUT and DELETE should be on /programmes/{code}

        // DELETE: Programmes/{code}
        [HttpDelete("{id}")]
        public IActionResult deleteProgramme(short id, [FromBody] Programme programme)
        {
            try
            {
                _database.Delete_Programme(id, programme);
                return StatusCode(204);
            }
            catch (Exception e)
            {
                return StatusCode(404);
            }

        }

        
        // We create this method so that we can use the responseMessage correctly.
        private void createProgramme(Programme programme, out string responseMessage)
        {
            try
            {
                _database.Create_Programme(programme, out responseMessage);
            }
            catch (Exception e)
            {
                responseMessage = e.Message;
            }
        }
    }
}
