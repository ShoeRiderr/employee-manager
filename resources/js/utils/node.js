export function _setAttributes(element, attributes) {
    Object.keys(attributes).forEach((attr) => {
        element.setAttribute(attr, attributes[attr]);
    });
}

export function addOnClickNodeListEl(nodes, callback) {
    let i;

    for (i = 0; i < nodes.length; i += 1) {
      ((i) => {
        let singleNode = nodes[i];

        singleNode.onclick = (event) => {
          callback(event, singleNode);
        };
      })(i);
    }
  };
