import { IProduct } from "@/interfaces/IProduct";

export const addToCart = async (
  product: IProduct,
  idNumber: number,
  quantidade: number
): Promise<boolean> => {
  const response = await fetch("http://localhost:8080/produtos/", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      id_produto: product.id_produto,
      produto: product.produto,
      id_marca: idNumber,
      imagem: product.imagem,
      preco: product.preco,
      quantidade: quantidade,
    }),
  });
  return response.ok;
};
