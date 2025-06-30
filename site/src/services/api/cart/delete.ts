export const removeFromCart = async (
  id_cliente: number,
  id_produto: number
): Promise<void> => {
  const response = await fetch(
    `http://localhost:8080/carrinho?id_cliente=${id_cliente}&id_produto=${id_produto}`,
    {
      method: "DELETE",
      headers: {
        "Content-Type": "application/json",
      },
    }
  );
  return response.json();
};
