// This code came out of ChatGPT's brain. Make of it what you will.

document.addEventListener("DOMContentLoaded", () => {
  // Namespace for CHEML
  const CHEML_NS = "http://example.com/cheml";

  // Function to process a single <cheml:molecule> element
  function processMolecule(molecule) {
    // Create an SVG element
    const svgNS = "http://www.w3.org/2000/svg";
    const svg = document.createElementNS(svgNS, "svg");
    svg.setAttribute("width", "200");
    svg.setAttribute("height", "200");
    svg.style.border = "1px solid black";

    // Parse <cheml:atom> elements
    const atoms = Array.from(molecule.getElementsByTagNameNS(CHEML_NS, "atom"));
    atoms.forEach(atom => {
      const x = parseFloat(atom.getAttribute("x")) * 50 + 100;
      const y = parseFloat(atom.getAttribute("y")) * 50 + 100;
      const element = atom.getAttribute("element");

      // Create a circle for the atom
      const circle = document.createElementNS(svgNS, "circle");
      circle.setAttribute("cx", x);
      circle.setAttribute("cy", y);
      circle.setAttribute("r", "10");
      circle.setAttribute("fill", "blue");
      svg.appendChild(circle);

      // Add a label for the atom
      const text = document.createElementNS(svgNS, "text");
      text.setAttribute("x", x);
      text.setAttribute("y", y + 5);
      text.setAttribute("text-anchor", "middle");
      text.setAttribute("fill", "white");
      text.setAttribute("font-size", "10");
      text.textContent = element;
      svg.appendChild(text);
    });

    // Parse <cheml:bond> elements
    const bonds = Array.from(molecule.getElementsByTagNameNS(CHEML_NS, "bond"));
    bonds.forEach(bond => {
      const from = bond.getAttribute("from");
      const to = bond.getAttribute("to");

      const atom1 = atoms.find(atom => atom.getAttribute("id") === from);
      const atom2 = atoms.find(atom => atom.getAttribute("id") === to);

      if (atom1 && atom2) {
        const x1 = parseFloat(atom1.getAttribute("x")) * 50 + 100;
        const y1 = parseFloat(atom1.getAttribute("y")) * 50 + 100;
        const x2 = parseFloat(atom2.getAttribute("x")) * 50 + 100;
        const y2 = parseFloat(atom2.getAttribute("y")) * 50 + 100;

        // Create a line for the bond
        const line = document.createElementNS(svgNS, "line");
        line.setAttribute("x1", x1);
        line.setAttribute("y1", y1);
        line.setAttribute("x2", x2);
        line.setAttribute("y2", y2);
        line.setAttribute("stroke", "black");
        svg.appendChild(line);
      }
    });

    // Replace the CHEML molecule with the generated SVG
    molecule.replaceWith(svg);
  }

  // Process all CHEML molecules in the document
  const molecules = document.getElementsByTagNameNS(CHEML_NS, "molecule");
  Array.from(molecules).forEach(processMolecule);
});
