export const updateCartQuantity = async (
  id_cliente: number,
  id_produto: number,
  delta: number,
  token?: string
): Promise<void> => {
  try {
    const response = await fetch("http://localhost:8080/carrinho/put.php", {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
        ...(token && { Authorization: `Bearer ${token}` }),
      },
      body: JSON.stringify({
        id_cliente,
        id_produto,
        quantidade: delta,
      }),
    });

    if (!response.ok) {
      const errorText = await response.text();
      console.error("Erro na requisição PUT:", response.status, errorText);
      throw new Error(`Falha na requisição: ${response.status} - ${errorText}`);
    }
  } catch (error) {
    console.error("Erro ao atualizar quantidade:", error);
    throw error;
  }
};
