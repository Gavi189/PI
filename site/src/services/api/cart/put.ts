export const updateCartQuantity = async (
  id_cliente: number,
  id_produto: number,
  delta: number
): Promise<void> => {
  try {
    const response = await fetch("/api/carrinho/put.php", {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
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
