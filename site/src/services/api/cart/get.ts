import { CartItemResponse, CartResponse, ICart } from "@/interfaces/ICart";

export const fetchCart = async (id_cliente: number): Promise<ICart> => {
  const response = await fetch(
    `/api/carrinho/get.php?id_cliente=${id_cliente}`,
    {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    }
  );
  const data: CartResponse = await response.json();
  if (data.status !== "success") throw new Error(data.message);
  return {
    items: data.data.items.flatMap((item) =>
      item.produtos.map((p: CartItemResponse) => ({
        product: {
          id_produto: p.id_produto,
          produto: p.produto,
          descricao: p.descricao,
          id_marca: p.id_marca,
          imagem: p.imagem,
          preco: p.preco,
          marca: p.marca,
        },
        quantity: p.quantidade,
      }))
    ),
    total: data.data.total,
  };
};
