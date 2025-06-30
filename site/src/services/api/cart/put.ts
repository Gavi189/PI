export const updateCartQuantity = async (
  id_cliente: number,
  id_produto: number,
  quantidade: number
): Promise<void> => {
  const response = await fetch("http://localhost:8080/carrinho/", {
    method: "PUT",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      id_cliente,
      id_produto,
      quantidade,
    }),
  });
  return response.json();
};
