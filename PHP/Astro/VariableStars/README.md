
README
======

This folder contains the start files for the VariableStars database. The files are as follows:

    star-tables-simple.sql
  
The definition of two relations to hold constellation information and a relation to hold the
star information

    star-data-constellation.sql
    
The data needed to populate the constellation table (constellation names and abbreviations).
This data needs to be loaded before star-data below so that referential integrity checks in the
star data will pass.

    star-data.sql
  
The data set. This file contains information on 47660 variables. One of the records is for a
variable with a period of more than 10,000 days. This won't fit into the NUMERIC(7,3) datatype
used for the period (which only allows for up to 9999.999 days). Thus the number of records that
insert successfully is only 47659.
